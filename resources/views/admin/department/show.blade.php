@extends('adminlte::page')

@section('title', 'View Department')

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
                    <th>Id:</th>
                    <td>{{$department->id}}</td>
                </tr>

                <tr>
                    <th>Title</th>
                    <td>{{$department->title}}</td>
                </tr>


            </table>

              <a href="{{route('department.index')}}">
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
