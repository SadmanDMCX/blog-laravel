@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            List of Categories
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Category Name</th>
                        <th class="text-center">Update</th>
                        <th class="text-center">Remove</th>
                    </thead>

                    <tbody>
                        @if($categories->count() > 0)
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td class="text-center"><a class="btn btn-sm btn-info" href="{{route('category.edit', ['id' => $category->id])}}">Update</a></td>
                                    <td class="text-center"><a class="btn btn-sm btn-danger" href="{{route('category.remove', ['id' => $category->id])}}">Remove</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">No categories</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop