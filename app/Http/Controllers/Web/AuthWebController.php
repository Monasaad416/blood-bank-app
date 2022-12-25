<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\City;
use App\Models\Client;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetWebPassword;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthWebController extends Controller
{
    public function clientRegister()
    {
        return view('web.pages.auth.register');
    }

    public function getCitiesByGovernorate($governorate_id)
    {
        $listOfCities = City::where('governorate_id',$governorate_id)->pluck('name','id');
        return response()->json($listOfCities);
    }


    public function clientStore(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:clients',
                'date_of_birth'=> 'required|date',
                'last_donation_date'=> 'nullable|date',
                'blood_type_id'=> 'required|exists:blood_types,id',
                'city_id'=> 'required|exists:cities,id',
                'phone'=> 'required|string|unique:clients',
                'password'=> 'required|string|min:5|max:25|confirmed',
            ]);

            $client = Client::create($request->all());
            $client->update([
                'password' =>Hash::make($request->password),
            ]);

            event(new Registered($client));
            Auth::guard('client-web')->login($client);

            //add row to pivot table client_governorate
            $client->governorates()->attach($client->city->governorate->id);

            //add row to pivot table blood_type_client
            $client->donationBloodTypes()->attach($client->blood_type_id);


            toastr()->success('Client logged in successfully', ['timeOut' => 5000]);
            return redirect(RouteServiceProvider::CLIENT);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }





    public function clientCreateLogin()
    {
        return view('web.pages.auth.login');
    }


    public function clientLogin(Request $request)
    {
        try{
            $request->validate([
                'phone'=> 'required|string',
                'password'=> 'required|string|min:5|max:25',
            ]);
            if(auth('client-web')->attempt($request->only('phone','password'))){
                toastr()->success('Client logged in successfully', ['timeOut' => 5000]);
                return redirect()->route('web.home');
            }
                toastr()->error('Credentials Error', ['timeOut' => 5000]);
                return redirect()->back();

            // done


            // $client = Client::where('phone', $request->phone)->first();
            // if ($client){
            //     $correctPassword = Hash::check($request->password , $client->password);
            //     if($correctPassword){
            //         auth('client-web')->login($client);
            //         toastr()->success('Client logged successfully.', 'New Record', ['timeOut' => 5000]);
            //         return redirect()->route('web.home');

            //     } else {
            //         toastr()->error('In correct password.','Error', ['timeOut' => 5000]);
            //         return redirect()->back();

            //     }
            // } else {

            //     toastr()->error('Client dose not exist.','Error', ['timeOut' => 5000]);
            //     return redirect()->intended(RouteServiceProvider::CLIENT);

            // }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function clientLogout(Request $request)
    {
        try{

            Auth::guard('client-web')->logout();

            $request->session()->invalidate();


            $request->session()->regenerateToken();
            toastr()->warning('You are logged out successfully', ['timeOut' => 5000]);
            return redirect()->route('web.home');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    //reset password links
    public function forgetPasswordView()
    {
        return view('web.pages.auth.forgot-password');
    }


    public function forgetPassword(Request $request)
    {
        try{
            $request->validate([
                'phone'=> 'required|string',
            ]);

            $client = Client::where('phone', $request->phone)->first();

            if($client){
                $pinCode = rand(1111,9999);
                $updatedClient = $client->update([
                    'pin_code' => $pinCode,
                ]);



                if($updatedClient !== null) {
                    //send sms with pincode
                    //send email with pincode
                    Mail::to($client->email)
                        ->bcc('monaabozaid164@gmail.com')
                        ->send(new  ResetPassword($pinCode));


                        toastr()->success('Code has been sent to your email succssfully', ['timeOut' => 5000]);
                        return redirect()->route('client.password.reset');

                } else {
                        toastr()->warning('Try again,there is an error ', ['timeOut' => 5000]);
                        return redirect()->back();
                }
            } else {
                toastr()->warning('Phone not exist', ['timeOut' => 5000]);
                return redirect()->back();
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function newPassword()
    {
     return view('web.pages.auth.create_new_password');

    }

    public function updatePassword(Request $request)
    {
        try{
            $request->validate([
                'pin_code'=> 'required',
                'password'=>'required|confirmed',
            ]);

            $client = Client::where('pin_code', $request->pin_code)->where('pin_code','!=',0)->first();

            if($client){
                $updatedClient = $client->update([
                    'password' => Hash::make($request->password),
                    'pin_code' => null,
                ]);

                if($updatedClient !== null) {
                    toastr()->success('Password has been updated successfully', ['timeOut' => 5000]);
                    return view('web.pages.auth.login');


                } else {
                    toastr()->success('Try again,there is an error', ['timeOut' => 5000]);
                    return redirect()->back();
                }
            } else {
                toastr()->success('Incorrect code', ['timeOut' => 5000]);
                return redirect()->back();
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    public function ClientEditProfile()
    {
        return view('web.pages.edit-profile');
    }

    public function ClientUpdateProfile(Request $request)
    {
        try{
            $request->validate([
                'name'=> 'string',
                'email' => [Rule::unique('clients')->ignore($request->user()->id)],
                'date_of_birth'=> 'date',
                'blood_type_id'=> 'exists:blood_types,id',
                'city_id'=> 'exists:cities,id',
                'phone'=> 'string', [Rule::unique('clients')->ignore($request->user()->id)],
            ]);

            $loggedClient = $request->user();
            $loggedClient->update($request->all());

            if($request->has('password')){
                $newPassword = Hash::make($request->password);
                $loggedClient->update([
                    'name'=> $request->name,
                    'email' => $request->email,
                    'date_of_birth'=> $request->date_of_birth,
                    'blood_type_id'=> $request->blood_type_id,
                    'city_id'=> $request->city_id,
                    'phone'=> $request->phone,
                    'password' => $newPassword,
                ]);
            }
            else {
                $loggedClient->update($request->all());
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        toastr()->success('Profile has been upodated successfully', ['timeOut' => 5000]);
            return redirect()->route('web.home');

    }
}
