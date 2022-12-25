<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageWebController extends Controller
{
    public function sendMessage(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone'=> 'required|string',
                'title'=> 'required|string',
                'content'=> 'required|string',
            ]);

            $is_client = Client::where('name',$request->name)->where('email',$request->email)->first();
            if($is_client){
                Message::create([
                    'client_id' => Auth::guard('client-web')->user()->id,
                    'title' =>$request->title,
                    'content' =>$request->content
                ]);
            }

            toastr()->success('Message has been sent successfully', ['timeOut' => 5000]);
            return redirect()->back();
            } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
