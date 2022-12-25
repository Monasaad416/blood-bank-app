<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Post;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $data['clients'] = Client::where(function($query) use ($request){
            if($request->has('keyword')){
                $query->where('name', 'like', '%'.$request->keyword.'%');
            }

        })->where(function($query2) use ($request){
            if($request->has('keyword')){
                $query2->where('email', 'like', '%'.$request->email.'%');
            }

        })->get();
        return view('admin.pages.app_clients.index')->with($data);
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.pages.app_clients.show',['client'=>$client]);

    }


    public function destroy(Request $request)
    {
        try{
            $client = Client::findOrFail($request->id);
            return dd($client);
            $client->delete();
            toastr()->error('Client deleted successfully.', 'Delete Record', ['timeOut' => 5000]);

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function toggleActivate(Request $request)
    {
        try{
            $client = Client::findOrFail($request->id);
            if( $client->is_active == 1 ){
                $client->is_active = 0;
                $client->save();

            }else {
                $client->is_active = 1;
                $client->save();
            }
            toastr()->success('Client state updated successfully.', 'Update Record', ['timeOut' => 5000]);
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function filterClients(Request $request){
        try{
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
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
