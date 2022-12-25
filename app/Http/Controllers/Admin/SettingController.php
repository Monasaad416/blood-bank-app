<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function edit()
    {
        $settings = Setting::firstorcreate();
        return view('admin.pages.app_settings.edit',['settings'=>$settings]);




    }
    public function update(Request $request)
    {
        $request->validate([
            'notification_settings'=> 'nullable|string',
            'about_app'=> 'nullable|string',
            'phone'=> 'nullable|string',
            'email'=> 'nullable|email',
            'fb_url'=> 'nullable|url',
            'tw_url'=> 'nullable|url',
            'insta_url'=> 'nullable|url',
            'whatsapp_url'=> 'nullable|url',
            ]);

            $settings = Setting::first();
            $settings->update($request->all());
            $settings->save();

       return redirect()->route('settings.edit');
    }
}
