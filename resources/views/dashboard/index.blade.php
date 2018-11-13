@extends('adminlte::page')

@section('title', $title)


@section('content_header')
    <h1>{!! $title !!}</h1>
@stop

@section('content')
@include('dashboard.header')

<div class="row">
    <div class="col-sm-6">
        @include('dashboard.list')
    </div>
    <div class="col-sm-6">
        @include('dashboard.graph')
    </div>
</div>

@include('dashboard.map')
@stop