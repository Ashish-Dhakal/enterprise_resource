@extends('adminlte::page')

@section('title', 'View Appreciation')

@section('content_header')

@stop

@section('content')
    <div class="container">
        <div class="card-body">
            <h4>Id: {{ $salary->id }}</h4>
            <h4>Employee Name: {{ $salary->employee->first_name }}</h4>
            <h4> Title: {{ $salary->amount }}</h4>
            <h4> Effective Date: {{ $salary->effective_date }}</h4>
        </div>
        <a href="{{ route('salary.index') }}">
            <div class="button">
                <button class="btn btn-primary" type="submit">Back</button>
            </div>
        </a>
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
