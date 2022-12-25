<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profileInfo($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('admin.pages.profile.profile')->with($data);
    }

    public function updateProfileInfo(Request $request)
    {
        try{}
        $user = User::findOrFail($request->id);
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id, 'id')
            ],
        ]);

        if($request->has('password')){
            $user->update([
                'name' => $request->name,
                'email' =>$request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' =>$request->email,
            ]);
        }

        toastr()->success('Profile updated successfully.', 'Edit Record', ['timeOut' => 5000]);
        return redirect()->route('profile.show',['id'=>$user->id]);
    }


    public function changePassword(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);


        toastr()->success('User password updated successfully.', 'Edit Record', ['timeOut' => 5000]);
        return redirect()->route('users.index');
    }
}
