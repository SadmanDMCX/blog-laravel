@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            List of Users
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th class="text-center">Permissions</th>
                    <th class="text-center">Remove</th>
                    </thead>

                    <tbody>
                    @if($users->count() > 0)
                        @foreach($users as $user)
                            <tr>
                                <td><img src="{{asset($user->profile->avatar)}}" alt="Post Image" width="60" height="60" style="border-radius: 50%;"></td>
                                <td>{{$user->name}}</td>
                                <td class="text-center">
                                    @if ($user->admin)
                                        <a href="{{route('user.admin', ['id' => $user->id])}}" class="btn btn-danger btn-xs">Remove</a>
                                    @else
                                        <a href="{{route('user.admin', ['id' => $user->id])}}" class="btn btn-success btn-xs">Admin</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (Auth::id() == $user->id)
                                        User Authenticated
                                    @else
                                        <a href="{{route('user.remove', ['id' => $user->id])}}" class="btn btn-success btn-xs">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No users</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop