<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::all();
        return view('admin.pages.categories.index')->with($data);

    }

    public function create()
    {
        return view('admin.pages.categories.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|unique:categories,name',
            ]);
            Category::create($request->all());

            toastr()->success('Category added successfully.', 'New Record', ['timeOut' => 5000]);

            return redirect()->route('categories.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $data['category'] = Category::findOrFail($id);
        return view('admin.pages.categories.edit')->with($data);
    }


    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required|string|unique:categoriess,name',
            ]);
            $categories = Category::findOrFail($request->id);
            $categories->update($request->all());

            toastr()->success('Category edited successfully.', 'Edit Record', ['timeOut' => 5000]);

            return redirect()->route('categoriess.index');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $category = Category::findOrFail($request->id);
            $category->delete();
            toastr()->error('Category deleted successfully.', 'Delete Record', ['timeOut' => 5000]);

            return redirect()->route('categories.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function filter($searchTerm){
        return $searchTerm;
    }
}
