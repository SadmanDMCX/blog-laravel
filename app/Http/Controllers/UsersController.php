<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Session;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt('123123'),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/images/default.jpg',
            'about' => 'Fill up about you',
            'facebook' => 'https://facebook.com/...',
            'youtube' => 'https://youtube.com/...',
        ]);

        Session::flash('success', 'New user created');

        return redirect()->route('user.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->profile->delete();
        $user->delete();

        Session::flash('success', 'User deleted.');

        return redirect()->back();
    }

    public function admin($id) {
        $user = User::find($id);
        $user->admin = !$user->admin;
        $user->save();

        Session::flash('success', 'User permission changed successfully!');

        return redirect()->back();
    }
}
