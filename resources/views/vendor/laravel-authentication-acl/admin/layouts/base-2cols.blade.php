@extends('admin.layouts.base')

@section('container')
    <div class="row">
        <div class="col-sm-3">
            <div class="sidebar">
            @include('admin.layouts.sidebar')
            </div>
        </div>
        <div class="col-sm-9 main">
            @yield('content')
        </div>
    </div>
@stop