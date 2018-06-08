<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Category;
use App\Post;
use App\Tag;
use App\User;

class FrontEndController extends Controller
{
    public function index() {

        // category choose at random
        $categories = Category::all();
        $category_id = array();
        foreach ($categories as $category) {
            array_push($category_id, $category->id);
        }
        $category_index = 0;
        $temp_index = -1;
        $category = [];
        $category_posts = [];
        $attempts = 0;
        while (true) {
            $index = rand(0, sizeof($category_id) - 1);

            // generate a category and related posts sheet
            if ($temp_index != $index) {
                $categoryId = $category_id[$index];
                $category[$category_index] = $categories->find($categoryId);
                $category_posts[$category_index] = $category[$category_index]->posts()->take(3)->get();
                if (!empty($category_posts[$category_index]->all()) && $category_index == 2) {
                    break;
                } else if (!empty($category_posts[$category_index]->all())) {
                    $category_index += 1;
                    $temp_index = $index;
                } else {
                    $attempts += 5;
                }
            }

            // loop stops after 20 attempts
            if ($attempts >= 100) {
                break;
            }
        }

        if (sizeof($category) > 1) {
            array_pop($category);
            array_pop($category_posts);
        }

        // page contents
        $data = [
            'title' => Setting::first()->site_name,
            'latest_post' => Post::orderBy('created_at', 'desc')->first(),
            'recent_posts' => Post::orderBy('created_at', 'desc')->skip(1)->take(2)->get()->all(),

            'categories' => Category::take(5)->get(),
            'category' => $category,
            'category_posts' => $category_posts,

            'settings' => Setting::first(),
        ];

        return view('index')->with('data', $data);
    }

    public function post($slug) {

        // slug
        $post = Post::where('slug', $slug)->first();
        $user = User::where('id', $post->user_id)->first();

        // page contents
        $data = [
            'title' => Setting::first()->site_name,
            'categories' => Category::take(5)->get(),
            'settings' => Setting::first(),
            'post' => $post,
            'user' => $user,
            'next_post' => Post::find(Post::where('id', '>', $post->id)->min('id')),
            'prev_post' => Post::find(Post::where('id', '<', $post->id)->max('id')),
            'tags' => Tag::all(),
        ];

        return view('post')->with('data', $data);
    }

    public function category($id) {

        $data = [
            'title' => Setting::first()->site_name,
            'category' => Category::find($id),
            'categories' => Category::take(5)->get(),
            'settings' => Setting::first(),
            'tags' => Tag::all(),
        ];
        return view('category')->with('data', $data);

    }

    public function tag($id) {

        $data = [
            'title' => Setting::first()->site_name,
            'tag' => Tag::find($id),
            'categories' => Category::take(5)->get(),
            'settings' => Setting::first(),
            'tags' => Tag::all(),
        ];
        return view('tag')->with('data', $data);

    }

    public function search() {

        $data = [
            'title' => Setting::first()->site_name,
            'categories' => Category::take(5)->get(),
            'settings' => Setting::first(),
            'posts' => Post::where('title', 'like', '%'.request('query').'%')->get(),
            'search_for' => request('query'),
        ];
        return view('results')->with('data', $data);

    }
}
