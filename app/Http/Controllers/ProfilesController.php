<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;

class ProfilesController extends Controller
{
    public function index()
    {
        return view('admin.users.profile')->with('user', Auth::user());
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'facebook' => 'required|url',
            'youtube' => 'required|url',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatar = $request['avatar'];
            $avatar_new_name = time() . $avatar->getChildOriginalName();
            $avatar_full_path = 'uploads/avatars/images/' . $avatar_new_name;

            $avatar->move('uploads/avatars/images/', $avatar_new_name);
            $user->profile->avatar = $avatar_full_path;
            $user->profile->save();
        }

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->profile->facebook = $request['facebook'];
        $user->profile->youtube = $request['youtube'];
        $user->profile->about = $request['about'];

        $user->save();
        $user->profile->save();

        if ($request->has('old_password') && $request->has('password')) {
            if (!empty($request['old_password']) && !empty($request['password'])) {
                if (!Hash::check($request['old_password'], $user->password)) {
                    Session::flash('warning', 'Sorry your old password didn\'t matched. New password not updated.');
                    return redirect()->back();
                } else {
                    $this->validate($request, [
                        'password' => 'string|min:6',
                    ]);

                    $user->password = bcrypt($request['password']);
                    $user->save();
                }
            }
        }

        Session::flash('success', 'Profile updated successfully.');

        return redirect()->back();
    }

    public function destroy($id)
    {

    }
}
