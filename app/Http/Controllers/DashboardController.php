<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = [
            'posts' => Post::all()->count(),
            'trashed' => Post::onlyTrashed()->get()->count(),
            'users' => User::all()->count(),
            'categories' => Category::all()->count(),
        ];
        return view('admin.dashboard')->with('total', $total);
    }
}
