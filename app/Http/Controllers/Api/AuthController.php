<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Client;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Traits\ApiResponseTrait;
use App\Models\NotificationToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ResetPassword as MailResetPassword;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:clients',
                'date_of_birth'=> 'required|date',
                'last_donation_date'=> 'nullable|date',
                'blood_type_id'=> 'required|exists:blood_types,id',
                'city_id'=> 'required|exists:cities,id',
                'phone'=> 'required|string|unique:clients',
                'password'=> 'required|string|min:5|max:25|confirmed',
            ]);
                if ($validator->fails()) {
                    return response()->json([
                        $validator->errors()
                    ],422);
                }

            $client = Client::create($request->all());
            $client->update([
                'password' =>Hash::make($request->password),
            ]);
            $client->api_token = Str::random(64);
            $client->save();

            $city = $client->city;

            //add row to pivot table client_governorate
            $client->governorates()->attach($city->governorate->id);

        //add row to pivot table blood_type_client
            $client->donationBloodTypes()->attach($client->blood_type_id);


            return $this->apiResponse('200','Client Added Successfully',[
                'api_token' =>$client->api_token,
                'client' => $client,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function login(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'phone'=> 'required|string',
                'password'=> 'required|string|min:5|max:25',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],500);
            }

            $client = Client::where('phone', $request->phone)->first();
            if ($client){
                $correctPassword = Hash::check($request->password , $client->password);
                if($correctPassword){
                    $newAccessToken = Str::random(64);
                    $client->update([
                        'api_token' => $newAccessToken,
                    ]);

                    return $this->apiResponse('200','user logged successfully',[
                        'api_token' => $newAccessToken,
                        'client'=> $client,
                        'user' => $request->user(),
                    ]);

                } else {
                    return $this->apiResponse('422','Incorrect Password');
                }
            } else {
                return $this->apiResponse('422','Phone number dose not exist');
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function logout(Request $request)
    {
        try{
            $api_token = $request->header('api_token');
            $client = Client::where('api_token',$api_token)->first();

            $client->update([
                'api_token' => null
            ]);
            return $this->apiResponse('200','Client logged out successfully');
                }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function resetPassword(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'phone'=> 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    $validator->errors(),409
                ]);
            }
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
                        ->send(new ResetPassword($pinCode));


                } else {
                    return $this->apiResponse('0','Try again');
                }
            } else {
                return $this->apiResponse('0','There is no account related to this phone number');
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function sendNewPassword(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'pin_code'=> 'required',
                'password'=>'required|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }
            $client = Client::where('pin_code', $request->pin_code)->where('pin_code','!=',0)->first();

            if($client){
                $updatedClient = $client->update([
                    'password' => Hash::make($request->password),
                    'pin_code' => null,
                ]);

                if($updatedClient !== null) {
                    return $this->apiResponse('200','Password updated successfully');


                } else {
                    return $this->apiResponse('0','Try again');
                }
            } else {
                return $this->apiResponse('0','Invalid pin code');
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function profile(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'email' =>'email', [Rule::unique('clients')->ignore($request->user()->id)],
                'phone'=> 'string', [Rule::unique('clients')->ignore($request->user()->id)],
                'password'=> 'string|min:5|max:25|confirmed',
            ]);
                if ($validator->fails()) {
                    return response()->json([
                        $validator->errors()
                    ],422);
                };


            $loggedClient = $request->user();
            $loggedClient->update($request->all());

            if($request->has('password')){
                $newPassword = Hash::make($request->password);
                $loggedClient->update(['password'=>$newPassword]);
            };

            return $this->apiResponse('200','Profile updated successfully',['client' => $request->user()]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function registerDeviceToken(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'token'=> 'required|string',// device token
                'type'=> 'required|string|min:5|max:25',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    $validator->errors(),409
                ]);
            }
            //remove old token
            NotificationToken::where('token' , $request->token)->delete();
            $request->user()->notificationTokens()->create(
                $request->all(),
            );
            return $this->apiResponse('200','Notification token created successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function removeDeviceToken(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'token'=> 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    $validator->errors(),409
                ]);
            }
            NotificationToken::where('token',$request->token)->delete();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
