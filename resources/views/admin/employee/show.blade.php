@extends('adminlte::page')

@section('title', 'Employee')

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
                    <th>First Name:</th>
                    <td>{{$employee->first_name}}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{$employee->last_name}}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{$employee->dob}}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{$employee->gender}}</td>
                </tr>
                <tr>
                    <th>Number</th>
                    <td>{{$employee->number}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$employee->email}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{$employee->address}}</td>
                </tr>
                <tr>
                    <th>Hire Date</th>
                    <td>{{$employee->hire_date}}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>{{$employee->position}}</td>
                </tr>
            </table>
             <a href="{{route('employee.index')}}">
        <div class="button">
        <button class="btn btn-primary" type="submit">Back</button>
    </div></a>
    </div>









</div>


   
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @stop