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
            Category
        </div>

        <div class="panel-body">
            <form action="{{route('category.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-md-3 text-right">
                            <label for="type" style="margin-right: 5px;">Type:</label>
                            <select name="type" id="type" class="pull-right">
                                <option value="multiple">Multiple</option>
                                <option value="single">Single</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Save Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection