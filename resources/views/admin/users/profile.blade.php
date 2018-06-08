@extends('layouts.app')

@section('content')

    @if(count($errors) > 0)
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">{{$error}}</li>
            @endforeach
        </ul>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            User Profile
        </div>

        <div class="panel-body">
            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="avatar">Your Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>

                <div class="form-group">
                    <label for="facebook">Facebook Account</label>
                    <input type="text" name="facebook" id="facebook" class="form-control" value="{{$user->profile->facebook}}">
                </div>

                <div class="form-group">
                    <label for="youtube">Youtube Account</label>
                    <input type="text" name="youtube" id="youtube" class="form-control" value="{{$user->profile->youtube}}">
                </div>

                <div class="form-group">
                    <label for="about">About you</label>
                    <textarea name="about" id="about" class="form-control" cols="5" rows="5">{{$user->profile->about}}</textarea>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop