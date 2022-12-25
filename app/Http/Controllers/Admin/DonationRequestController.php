<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use App\Http\Controllers\Controller;

class DonationRequestController extends Controller
{
    public function index()
    {
        $data['donationRequests'] = DonationRequest::all();
        return view('admin.pages.donation_requests.index')->with($data);
    }


    public function show($id)
    {
        $data['donationRequest'] = DonationRequest::where('id',$id)->first();
        return view('admin.pages.donation_requests.show')->with($data);
    }


    public function destroy(Request $request)
    {
        try{
            $donationRequest = DonationRequest::findOrFail($request->id);
            $donationRequest->delete();
            toastr()->error('Donation Request deleted successfully.', 'Delete Record', ['timeOut' => 5000]);

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
