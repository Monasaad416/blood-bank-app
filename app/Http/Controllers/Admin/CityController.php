<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index()
    {
        $data['cities'] = City::all();
        return view('admin.pages.cities.index')->with($data);

    }

    public function create()
    {
        return view('admin.pages.cities.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|unique:cities,name',
            ]);
            City::create($request->all());

            toastr()->success('City added successfully.', 'New Record', ['timeOut' => 5000]);

            return redirect()->route('cities.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['city'] = City::findOrFail($id);
        return view('admin.pages.cities.edit')->with($data);
    }


    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required|string|unique:cities,name',
            ]);
            $city = City::findOrFail($request->id);
            $city->update($request->all());

            toastr()->success('City edited successfully.', 'Edit Record', ['timeOut' => 5000]);

            return redirect()->route('cities.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $city = City::findOrFail($request->id);
            $city->delete();
            toastr()->error('City deleted successfully.', 'Delete Record', ['timeOut' => 5000]);

            return redirect()->back();
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
