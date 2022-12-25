<?php

namespace App\Http\Controllers\Admin;

use toastr;
use Exception;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernorateController extends Controller
{
    public function index()
    {
        $data['governorates'] = Governorate::all();
        return view('admin.pages.governorates.index')->with($data);

    }

    public function create()
    {
        return view('admin.pages.governorates.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|unique:governorates,name',
            ]);
            Governorate::create($request->all());

            toastr()->success('Governorate added successfully.', 'New Record', ['timeOut' => 5000]);

            return redirect()->route('governorates.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $data['governorate'] = Governorate::findOrFail($id);
        return view('admin.pages.governorates.edit')->with($data);
    }


    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required|string|unique:governorates,name',
            ]);
            $governorate = Governorate::findOrFail($request->id);
            $governorate->update($request->all());

            toastr()->success('Governorate edited successfully.', 'Edit Record', ['timeOut' => 5000]);

            return redirect()->route('governorates.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $governorate = Governorate::findOrFail($request->id);
            $governorate->delete();
            toastr()->error('Governorate deleted successfully.', 'Delete Record', ['timeOut' => 5000]);

            return redirect()->route('governorates.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
