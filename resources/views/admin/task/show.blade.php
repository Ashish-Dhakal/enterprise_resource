@extends('adminlte::page')

@section('title', 'View Tasks')

@section('content_header')

@stop

@section('content')
    <div class="container">
        <div class="card-body">
            <h4>Id: {{ $task->id }}</h4>
            <h4>Task Title: {{ $task->title }}</h4>
            <h4>Project title: {{ $task->project->title }}</h4>
            <h4>Description: {{ $task->description }}</h4>
            <h4>Deadline: {{ $task->deadline }}</h4>
            <h4>Completed At: {{ $task->completed_at }}</h4>
            <h4>Started At: {{ $task->started_at }}</h4>
        </div>
        <a href="{{ route('task.index') }}">
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
