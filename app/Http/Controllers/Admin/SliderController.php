<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sliders'] = Slider::all();
        return view('admin.pages.sliders.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'button' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        $path = Storage::putFile('sliders', $request->file('image'));

        Slider::create([
            'title' => $request->title,
            'image' => $path,
            'text' => $request->text,
            'button' => $request->button,
        ]);

        toastr()->success('Slider added successfully.', ['timeOut' => 5000]);

        return redirect()->route('sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['slider'] = Slider::findOrFail($id);
        return view('admin.pages.sliders.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'button' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

        $slider = Slider::Where('id',$id)->first();
        $path = $slider->image;


        if ($request->hasFile('image')) {
            Storage::delete($path);
            $path = Storage::putFile('sliders', $request->file('image'));
        }
        $slider->update([
            'title' => $request->title,
            'image' => $path,
            'text' => $request->text,
            'button' => $request->button,
        ]);

        toastr()->success('Slider updated successfully.', 'Edit Record', ['timeOut' => 5000]);

        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
