@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-info text-center">
                <div class="panel-heading">
                    POSTED
                </div>
                <div class="panel-body">
                    <h2 style="margin: 0;">
                        {{$total['posts']}}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger text-center">
                <div class="panel-heading">
                    TRASHED
                </div>
                <div class="panel-body">
                    <h2 style="margin: 0;">
                        {{$total['trashed']}}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-success text-center">
                <div class="panel-heading">
                    USERS
                </div>
                <div class="panel-body">
                    <h2 style="margin: 0;">
                        {{$total['users']}}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-warning text-center">
                <div class="panel-heading">
                    CATEGORIES
                </div>
                <div class="panel-body">
                    <h2 style="margin: 0;">
                        {{$total['categories']}}
                    </h2>
                </div>
            </div>
        </div>
    </div>

@endsection
