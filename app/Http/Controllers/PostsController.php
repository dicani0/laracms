<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Middleware\CheckCategoriesCount;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image',
            'category_id' => 'required'
        ]);

        $imgPath = $request->image->store('postimgs', 'public');
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $imgPath,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id
        ]);
        $post->tags()->attach($request->tags);
        session()->flash('success', 'Post created successfully!');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content', 'published_at', 'category_id']);
        if ($request->hasFile('image')) {
            $imgPath = $request->image->store('postimgs', 'public');
            $post->deleteImage();
            $data['image'] = $imgPath;
        }
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }
        $post->update($data);
        session()->flash('success', 'Post updated successfully!');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->find($id);
        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('success', 'Post deleted successfully!');
            return redirect(route('trashed-posts.index'));
        } else {
            $post->delete();
            session()->flash('success', 'Post trashed successfully!');
            return redirect(route('posts.index'));
        }
    }

    /**
     * Display a listing of the soft deleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('posts.index')->with('posts', Post::onlyTrashed()->get());
    }

    /**
     * Restore trashed post
     * 
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Post::withTrashed()->find($id)->restore();
        session()->flash('success', 'Post restored successfully!');
        return redirect(route('posts.index'))->with('posts', Post::onlyTrashed()->get());
    }
    /**
     * Checks if post has certain tag
     * 
     * @param Int $tagId
     * @return bool
     */
}
