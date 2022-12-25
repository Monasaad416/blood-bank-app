<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::all();
        return view('admin.pages.posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'title' => 'required|string',
                'image' => 'required|image',
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id'
            ]);
            $path = Storage::putFile('posts', $request->file('image'));

            Post::create([
                'title' => $request->title,
                'image' => $path,
                'content' => $request->content,
                'category_id' => $request->category_id,
            ]);
            toastr()->success('Post added successfully.', 'New Record', ['timeOut' => 5000]);
            return redirect()->route('posts.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $data['post'] = Post::findOrFail($id);
        return view('admin.pages.posts.show')->with($data);

    }

    public function edit($id)
    {
        $data['post'] = Post::findOrFail($id);
        return view('admin.pages.posts.edit')->with($data);
    }

    public function update(Request $request)
    {
        try{
            $request->validate([
                'title' => 'required|string',
                'image' => 'nullable|image',
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id'
            ]);

            $post = Post::Where('id',$request->id)->first();
            $path = $post->image;

            if ($request->hasFile('image')) {
                Storage::delete($path);
                $path = Storage::putFile('posts', $request->file('image'));
            }

            $post->update([
                'title' => $request->title,
                'image' => $path,
                'content' => $request->content,
                'category_id' => $request->category_id,
            ]);

            toastr()->success('Post updated successfully.', 'Edit Record', ['timeOut' => 5000]);
            return redirect()->route('posts.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try{
            $post = Post::findOrFail($request->id);
            $post->delete();
            toastr()->warning('Post deleted successfully.', 'Delete Record', ['timeOut' => 5000]);

            return redirect()->route('posts.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
