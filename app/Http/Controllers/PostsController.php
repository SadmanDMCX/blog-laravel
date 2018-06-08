<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use Auth;
use Session;
use File;

class PostsController extends Controller
{
    public function index()
    {
        return view('admin.posts.index')->with('posts', Post::all());
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        if ($categories->count() == 0 || $tags->count() == 0) {
            Session::flash('info', "You must have only one category and one tag to create a post.");
            return redirect()->back();
        }

        return view('admin.posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'featured' => 'required|image',
            'category_id' => 'required',
            'tags' => 'required',
        ]);

        $feature_image = $request->featured;
        $feature_image_name = time() . $feature_image->getClientOriginalName();
        $feature_image_path = 'uploads/posts/images/' . $feature_image_name;
        $feature_image->move('uploads/posts/images/', $feature_image_name);

        $post = Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'featured' => $feature_image_path,
            'category_id' => $request['category_id'],
            'slug' => str_slug($request['title']),
            'user_id' => Auth::id(),
        ]);

        $post->tags()->attach($request['tags']);

        Session::flash('success', "Successfully post created");

        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.posts.edit')->with('post', $post)->with('categories', $categories)->with('tags', Tag::all());
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $post = Post::find($id);

        if ($request->hasFile('featured')) {
            $feature_image = $request->featured;
            $feature_image_name = time() . $feature_image->getClientOriginalName();
            $feature_image->move('uploads/posts/images/', $feature_image_name);
            $feature_image_path = 'uploads/posts/images/' . $feature_image_name;

            $post->featured = $feature_image_path;
        }

        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->category_id = $request['category_id'];
        $post->save();

        $post->tags()->sync($request['tags']);

        Session::flash('success', "Post updated successfully");

        return redirect()->route('post.index');

    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $image = public_path(parse_url($post->featured)['path']);
        $post->forceDelete();

        if (File::exists($image)) {
          File::delete($image);
        } else {
            dd("File Not found");
        }

        Session::flash('success', 'Post deleted permanently.');

        return redirect()->back();
    }

    public function trash($id) {
        $post = Post::find($id);
        $post->delete();

        Session::flash('success', "The post was trashed.");

        return redirect()->back();
    }

    public function trashed() {
        return view('admin.posts.trashed')->with('posts', Post::onlyTrashed()->get());
    }

    public function restore($id) {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        Session::flash('success', 'Successfully restored the post.');

        return redirect()->route('post.index');
    }
}
