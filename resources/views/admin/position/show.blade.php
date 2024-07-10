@extends('adminlte::page')

@section('title', 'View Position')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="card-body">
        <h4>Position: {{$position->title}}</h4>
        <h4>Department: {{$department->title}}</h4>
    </div>
    <a href="{{route('position.index')}}">
        <div class="button">
        <button class="btn btn-primary" type="submit">Back</button>
    </div></a>
</div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @stop
