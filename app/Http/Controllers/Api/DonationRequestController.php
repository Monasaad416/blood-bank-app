<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Client;
use App\Models\Governorate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use App\Traits\ApiResponseTrait;
use App\Events\DonationRequestAdded;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DonationRequestController extends Controller
{
    use ApiResponseTrait;

    public function getNotificationSettings(Request $request)
    {
        try {
            $clientBloodTypes = $request->user()->donationBloodTypes;
            $clientGovernorates = $request->user()->governorates;
            return $this->apiResponse('200','client notification settings retrieved successfully',[
                'clientBloodTypes' => $clientBloodTypes,
                'clientGovernorates' => $clientGovernorates
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function updateNotificationSettings(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'blood_type_id.*' => 'exists:blood_types,id',
                'governorate_id.*' => 'exists:governorates,id',
            ]);
                if ($validator->fails()) {
                    return response()->json([
                        $validator->errors(),409
                    ]);
                }


                $clientBloodTypes = $request->user()->donationBloodTypes()->detach();
                $clientGovernorates = $request->user()->governorates()->detach();

                $clientBloodTypes = $request->user()->donationBloodTypes()->attach($request->blood_type_id);
                $clientGovernorates = $request->user()->governorates()->attach($request->governorate_id);
                return $this->apiResponse('200','client notification settings updated successfully',[
                    'clientBloodTypes' => $request->user()->donationBloodTypes,
                    'clientGovernorates' => $request->user()->governorates
                ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function createDonationRequest(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'patient_name' => 'required|string|max:255',
                'patient_age' => 'required|numeric',
                'blood_type_id'=> 'required|exists:blood_types,id',
                'bags_num' => 'required|numeric|min:1',
                'hospital_name'=> 'required|string',
                'hospital_address'=> 'required|string',
                'lattitude'=> 'required',
                'longitude'=> 'required',
                'city_id'=> 'required|exists:cities,id',
                'patient_phone'=> 'required|string|unique:donation_requests',
                'notes'=> 'required|string',
                'client_id'=> 'required|exists:clients,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }

            $donationRequest = $request->user()->donationRequests()->create($request->all());

            // DonationRequest::create($request->all());
            // $donationRequest = DonationRequest::latest()->first();


            //clients suitable for donation request

            // tokens wherehas client where --- look down
            // clients wherehas governorates whereHas city where id = donation->city_id
            // and wherehas bloddtypes where id = don->bt_id

            $clientsId = $donationRequest->city->governorate->clients()->whereHas('donationBloodTypes',function($query) use($request,$donationRequest) {
            $query->where('blood_types.id',$donationRequest->blood_type_id);
            })->pluck('clients.id')->toArray();


            $send= "";
            if($clientsId)
            {
                $donationRequest->notifications()->create([
                    'title' => 'There is a patient make donation request near you',
                    'content' => $donationRequest->bloodType->name .'need donation',
                ]);
                $notification = Notification::where('donation_request_id',$donationRequest->id)->first();

                //add row to client tonification table
                $notification->clients()->attach($clientsId);
                // return $this->apiResponse('200','ok',['notification' => $notification,'clients'=>$clientsId]);

                //send notifications using fcm

                $tokens = $request->user()->notificationTokens->where('token','!=','')->whereIn('client_id',$clientsId)->pluck('token')->toArray();
                if(count($tokens))
                {

                    $title = $notification->title;
                    $body = $notification->content;
                    $data = [
                        'donation_request_id' => $donationRequest->id
                    ];

                    function notifyByFirebase($title,$body,$tokens,$data=[])
                    {
                        $registrationIDs = $tokens;

                        $fcmMsg = array(
                            'body' => $body,
                            'title' => $title,
                            'sound' => 'default',
                            'color' => '#203E78',
                        );

                        $fcmFields = array(
                            'registration_ids' => $registrationIDs,
                            'priority' => 'high',
                            'notification' => $fcmMsg,
                            'data' => $data,
                        );

                        $headers = array(
                            'Authorization:key='.env('FIREBASE_API_ACCESS_KEY'),
                            'Content-Type: application/json',
                        );
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));

                        $result = curl_exec($ch);
                        curl_close($ch);
                        return $result;


                    }

                    $send = notifyByFirebase($title,$body,$tokens,$data);
                }

                event(new DonationRequestAdded);


                return $this->apiResponse('200','notification added successfully',['donation_request' =>$donationRequest]);
                // return $this->apiResponse('200','notification added successfully',$send);
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function donationRequests(Request $request)
    {
        try{
            $donationRequests = DonationRequest::where(function($query) use($request){
                    if($request->has('blood_type_id')){
                        $query->where('blood_type_id',$request->blood_type_id);
                    }
                })->where(function($query) use($request){
                    if($request->has('governorate_id')){
                        $query->whereHas('city',function($query) use($request){
                            $query->where('governorate_id',$request->governorate_id);
                        });
                    }
                })->get();

                    return $this->apiResponse('200','Get donation requests successfully',[
                        'donationRequests' => $donationRequests,
                    ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
