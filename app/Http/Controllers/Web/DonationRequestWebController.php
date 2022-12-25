<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\City;
use App\Models\Client;
use App\Models\BloodType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use App\Traits\ApiResponseTrait;
use App\Events\DonationRequestAdded;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DonationRequestWebController extends Controller
{

    use ApiResponseTrait;
    public function editNotificationsSetting(Request $request)
    {
        $data['client'] = $request->user();
        $data['clientBloodTypes'] = $request->user()->donationBloodTypes;
        $data['clientGovernorates'] = $request->user()->governorates;
        return view('web.pages.app_notifications.settings')->with($data);
    }


    public function updateNotificationsSetting(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'blood_type_id.*' => 'exists:blood_types,id',
            'governorate_id.*' => 'exists:governorates,id',
        ]);

            $clientBloodTypes = $request->user()->donationBloodTypes()->detach();
            $clientGovernorates = $request->user()->governorates()->detach();

            $data['clientBloodTypes'] = $request->user()->donationBloodTypes()->attach($request->blood_type_id);
            $data['clientGovernorates'] = $request->user()->governorates()->attach($request->governorate_id);
            toastr()->success('Notifications Settings have been updated successfully', ['timeOut' => 5000]);
            return redirect()->route('client.notifications.edit',$request->user()->id)->with($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function donationRequests(Request $request)
    {
        try{
            $data['cities'] = City::all();
            $data['bloodTypes'] = BloodType::all();
            $data['donationRequests'] = DonationRequest::where(function($query) use ($request){
                if($request->has('blood_type_id')){
                    $query->where('blood_type_id',$request->blood_type_id);
                }
                elseif($request->has('city_id')){
                    $query->where('city_id',$request->city_id);
                }
                elseif($request->has('blood_type_id','city_id')){
                    $query->where('blood_type_id',$request->blood_type_id)->where('city_id',$request->city_id);
                }
            })->paginate(15);
            return view('web.pages.donation-requests')->with($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showDonationRequest($id)
    {
        $data['donationReq'] = DonationRequest::findOrFail($id);
        // $this->readNotification( $data['donationReq']->client->notifications->notification_id);
        return view('web.pages.donation-request-details')->with($data);
    }




    public function AddDonationRequest()
    {
        return view('web.pages.create-donation-request');
    }


    public function storeDonationRequest(Request $request)
    {
        try{
            $request->validate([
                'patient_name' => 'required|string|max:255',
                'patient_age' => 'required|numeric',
                'blood_type_id'=> 'required|exists:blood_types,id',
                'bags_num' => 'required|numeric|min:1',
                'hospital_name'=> 'required|string',
                'hospital_address'=> 'required|string',
                'lattitude'=> 'nullable',
                'longitude'=> 'nullable',
                'city_id'=> 'required|exists:cities,id',
                'patient_phone'=> 'required|string|unique:donation_requests',
                'notes'=> 'required|string',
                'client_id'=> 'required|exists:clients,id',
            ]);

            $donationRequest = $request->user()->donationRequests()->create($request->all());
            //clients suitable for donation request

            $clientsId = $donationRequest->city->governorate->clients()->whereHas('donationBloodTypes',function($query) use($donationRequest) {
            $query->where('blood_types.id',$donationRequest->blood_type_id);
            })->pluck('clients.id')->toArray();



                $donationRequest->notifications()->create([
                    'title' => 'Donation request has been added near you',
                    'content' => $donationRequest->bloodType->name .'patiant need donation',
                ]);

                $notification = Notification::where('donation_request_id',$donationRequest->id)->first();


                //add row to client to nification table
                $notification->clients()->attach($clientsId);
                $notification->clients()->updateExistingPivot($request->user()->id, [
                    'is_read' => 0 ,

                ]);
                // return $this->apiResponse('200','ok',['notification' => $notification,'clients'=>$clientsId]);

                //send notifications using Auth::user();

                // event(new DonationRequestAdded);\



            toastr()->success('Donation request has been added successfully', ['timeOut' => 5000]);
            return redirect()->route('donation.requests');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function myNotifications(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(15);

        // $client = $request->user();
        // // $data['clientNotifications'] = $data['client']->notifications;
        // $bloodTypes = $client->donationBloodTypes->pluck('id')->toArray();
        // $governorates = $client->governorates->pluck('id')->toArray();

        // $cities = City::whereIn('governorate_id',$governorates)->pluck('id')->toArray();
        // $donationRequests = DonationRequest::whereIn('blood_type_id',$bloodTypes)->whereIn('city_id',$cities)->get();
        // $donationRequests = DonationRequest::whereHas('bloodType',function($query) use($request){
        //     $query->whereHas('clients',function($query) use($request){
        //         $query->where('clients.id',$request->user()->id);
        //     });
        // })
        // ->whereHas('city',function($query) use($request){
        //     $query->whereHas('governorate',function($query) use($request){
        //         $query->whereHas('clients',function($query) use($request){
        //             $query->where('clients.id',$request->user()->id);
        //         });
        //     });
        // })
        // ->toSql();
        // return dd($donationRequests);
        /*
        select * from `donation_requests` where exists
                                                (select * from `blood_types` where `donation_requests`.`blood_type_id` = `blood_types`.`id`
                                                and exists (select * from `clients` inner join `blood_type_client` on `clients`.`id` = `blood_type_client`.`client_id` where `blood_types`.`id` = `blood_type_client`.`blood_type_id` and `clients`.`id` = ?)) and exists (select * from `cities` where `donation_requests`.`city_id` = `cities`.`id` and exists (select * from `governorates` where `cities`.`governorate_id` = `governorates`.`id` and exists (select * from `clients` inner join `client_governorate` on `clients`.`id` = `client_governorate`.`client_id` where `governorates`.`id` = `client_governorate`.`governorate_id` and `clients`.`id` = ?)))
        */
        // $clientNotification = Notification::
        // $data['pivotRows'] = $client->notifications()->where('client_id', $client_id)->get();
        return view('web.pages.app_notifications.index')->with(compact('notifications'));
    }

    public function readNotification(Request $request,$notification_id)
    {
        try{
            $notification = Notification::findOrFail($notification_id);

            $notification->clients()->updateExistingPivot($request->user()->id, [
                'is_read' => 1 ,
            ]);

            return redirect()->route('donation.request.details',$notification->id);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
