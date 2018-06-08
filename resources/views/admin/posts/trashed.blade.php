@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            List of Trashed Posts
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Post Image</th>
                        <th>Post Title</th>
                        <th class="text-center">Update</th>
                        <th class="text-center">Restore</th>
                        <th class="text-center">Remove</th>
                    </thead>

                    <tbody>
                        @if($posts->count() > 0)
                            @foreach($posts as $post)
                                <tr>
                                    <td><img src="{{$post->featured}}" alt="Post Image" width="100"></td>
                                    <td>{{$post->title}}</td>
                                    <td class="text-center"><a class="btn btn-sm btn-info" href="{{route('post.edit', ['id' => $post->id])}}">Update</a></td>
                                    <td class="text-center"><a class="btn btn-sm btn-success" href="{{route('post.restore', ['id' => $post->id])}}">Restore</a></td>
                                    <td class="text-center"><a class="btn btn-sm btn-danger" href="{{route('post.remove', ['id' => $post->id])}}">Remove</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No trashed posts</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop