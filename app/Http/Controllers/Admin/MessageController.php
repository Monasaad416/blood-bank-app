<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::all();
        return view('admin.pages.messages.index')->with($data);

    }


    public function show($id)
    {
        $data['message'] = Message::where('id',$id)->first();
        return view('admin.pages.messages.show')->with($data);
    }


    public function destroy(Request $request)
    {
        try{
            $message = Message::findOrFail($request->id);
            $message->delete();
            toastr()->error('Message deleted successfully.', 'Delete Record', ['timeOut' => 5000]);

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
