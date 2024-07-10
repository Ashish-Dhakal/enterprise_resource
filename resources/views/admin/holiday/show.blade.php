@extends('adminlte::page')

@section('title', 'View Holiday')

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
  
    <a href="{{route('holiday.index')}}">
        <div class="button">
        <button class="btn btn-primary" type="submit">Back</button>
    </div></a>


      <div class="showbox">
            <table class="table table-bordered" id="employee-table">
                <tr>
                    <th>Id</th>
                    <td> {{$holiday->id}}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td> {{$holiday->date}}</td>
                </tr>
                <tr>
         
                    <th>Title</th>
                    <td>{{$holiday->title}}</td>
                </tr>
                <tr>
       
                    <th>Description</th>
                    <td>{{$holiday->description}}</td>
                </tr>
                <tr>
         
                    <th>Day</th>
                    <td>{{$holiday->day}}</td>
                </tr>
            </table>
      </div>
</div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @stop
