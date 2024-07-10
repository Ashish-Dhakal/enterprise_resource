@extends('adminlte::page')

@section('title', 'View Appreciation')

@section('content_header')

@stop
<style>
    .showbox{
        margin-top: 15px;
        border-radius: 8px;
    }
</style>

@section('content')
    <div class="container">
       


         <div class="showbox">
            <table class="table table-bordered" id="employee-table">
                <tr>
                    <th>Appreciation Id</th>
                    <td> {{$appreciation->id}}</td>
                </tr>

                <tr>
                    <th>Employee Name</th>
                    <td> {{ $appreciation->employee->first_name}}</td>
                </tr>

                <tr>
                    <th>Title</th>
                    <td> {{ $appreciation->title}}</td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td> {{ $appreciation->given_date}}</td>
                </tr>

            </table>

             <a href="{{ route('appreciation.index') }}">
            <div class="button">
                <button class="btn btn-primary" type="submit">Back</button>
            </div>
        </a>

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
