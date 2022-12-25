<?php

namespace App\Http\Controllers\Web;

use Exception;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Post;
use App\Models\Client;
use App\Models\Slider;
use App\Models\BloodType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

class MainWebController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        $data['posts'] = Post::where('created_at','<',Carbon::now()->toDateString())->latest()->take(6)->get();
        $data['bloodTypes'] = BloodType::all();
        $data['sliders'] = Slider::all();
        $data['cities'] = City::all();
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
        })->take(5)->get();
        return view('web.pages.index')->with($data);
    }


    public function posts()
    {
        $data['posts'] = Post::all();
        return view('web.pages.posts')->with($data);
    }


    public function whoAreUs()
    {
        return view('web.pages.who_are_us');
    }

    public function contactUs()
    {
        return view('web.pages.contact-us');
    }

    public function postDetails($id)
    {
        $post= Post::where('id',$id)->first();
        $relatedPosts = Post::where('category_id',$post->category_id)->whereNot('id', $post->id)->get();
        return view('web.pages.post-details',[
            'post'=>$post,
            'relatedPosts'=>$relatedPosts
            ]);
    }


    public function togglePostFavourite(Request $request,$id)
    {
        try{
            $toggle = $request->user()->posts()->toggle($id);
        return $this->apiResponse('200','Post favourite toggle successfully',['id' => $id]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function getMyFavouritePosts(Request $request)
    {
        $data['favPosts'] = $request->user()->posts()->latest()->paginate(20);
        return view('web.pages.favourite-posts')->with($data);
    }









}



