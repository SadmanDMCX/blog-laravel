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
            Update the tag
        </div>

        <div class="panel-body">
            <form action="{{route('tag.update', ['id' => $tag->id])}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="tag">Name</label>
                    <input type="text" name="tag" id="tag" class="form-control" value="{{$tag->tag}}">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update Tag</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection