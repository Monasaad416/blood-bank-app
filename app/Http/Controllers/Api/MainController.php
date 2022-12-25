<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\City;
use App\Models\Post;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    use ApiResponseTrait;


    public function governorates(Request $request){
        $governorates = Governorate::all();

        return $this->apiResponse('200','Get governtorates successfully',[
            'governorates' => $governorates,

        ]);
    }

    public function cities(Request $request){
        $cities = City::where(function($query) use ($request){
            if($request->has('governorate_id')){
                $query->where('governorate_id',$request->governorate_id);
            }

        })->with('governorate')->get();

        return $this->apiResponse('200','Get cities successfully',[
            'cities' => $cities,
        ]);
    }

    public function posts(Request $request){
        $posts = Post::where(function($query) use ($request){
            if($request->has('id')){
                $query->where('id',$request->id);
            }

        })->with('clients')->where(function($query2) use ($request){
            if($request->has('keyword')){
                $query2->where('title', 'like', '%'.$request->keyword.'%');
            }

        })->get();

        return $this->apiResponse('200','Get posts successfully',[
            'posts' => $posts,
        ]);
    }



    public function togglePostFavourite(Request $request){
        try{
            $rules = ['post_id' =>'required|exists:posts,id'];
            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],409);
            }

            $toggle = $request->user()->posts()->toggle($request->post_id);
            return $this->apiResponse('200','Post favourite toggle successfully',['toggle_state' =>$toggle]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getMyFavouritePosts(Request $request)
    {
        $favPosts = $request->user()->posts()->latest()->paginate(20);
        return $this->apiResponse('200','Get favourite posts successfully',[
            'favourite_Posts' => $favPosts,
        ]);
    }

    public function sendMessage(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'title'=> 'required|string',
                'content'=> 'required|string',
                'client_id'=> 'required|exists:clients,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    $validator->errors(),409
                ]);
            }

            $message = Message::create($request->all());

            return $this->apiResponse('200','Message sent successfully',['message' =>$message]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function settings(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'notification_setting_text'=> 'required|string',
                'about_app'=> 'required|string',
                'phone'=> 'required|string',
                'email'=> 'required|email',
                'fb_url'=> 'required|url',
                'tw_url'=> 'required|url',
                'insta_url'=> 'required|url',
                'whatsapp_url'=> 'required|url',
            ]);


            if ($validator->fails()) {
                return response()->json([
                    $validator->errors(),409
                ]);
            }

            $setting = Setting::create($request->all());

            return $this->apiResponse('200','Setting saved successfully',['setting' =>$setting]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
