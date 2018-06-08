@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            List of Tags
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Tag Name</th>
                        <th class="text-center">Update</th>
                        <th class="text-center">Remove</th>
                    </thead>

                    <tbody>
                        @if($tags->count() > 0)
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{$tag->tag}}</td>
                                    <td class="text-center"><a class="btn btn-sm btn-info" href="{{route('tag.edit', ['id' => $tag->id])}}">Update</a></td>
                                    <td class="text-center"><a class="btn btn-sm btn-danger" href="{{route('tag.remove', ['id' => $tag->id])}}">Remove</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">No tags</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop