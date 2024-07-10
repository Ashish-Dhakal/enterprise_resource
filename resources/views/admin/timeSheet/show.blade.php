@extends('adminlte::page')

@section('title', 'Show Time Sheet')

<!-- @section('content_header')

@stop -->

<style>
    .fa-arrow-left {
        padding: 10px;
        border: 1px solid #D5D5D5;
        border-radius: 50%;
        color: #C2699E;
    }

    .head-contain {
        display: flex;
        justify-content: space-between;
    }

    .export {
        border: 1px solid #D5D5D5;
        font-size: 16px;
        padding: 10px;
        border-radius: 8px;
        color: #C2699E;
    }

    .taskSheet-detail {
        border: 2px solid #D5D5D5;
        border-radius: 8px;
        width: 70%;
        padding: 10px;
        display: flex;
        justify-content: space-between;
    }

    .task-info label {
        width: 110px;
        padding: 8px
    }

    .tasktime-info .lb2 {
        width: 130px;
        padding: 8px
    }

    .task-info {
        width: 50%;
        border-right: dotted
    }

    .tasktime-info {
        width: 50%;
        padding-left: 50px;
    }
</style>

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">

        <div class="head-contain ">
            <div class="">
                <i class=" fas fa-arrow-left mt-4"></i> <span class="pl-4" style="font-size: 20px; color:#023E7D;">Time Sheet
                    Details</span>
            </div>
            <div class="export mt-4">
                <span>Export <i class="fas fa-file-export"></i></span>
            </div>
        </div>

        <hr>

        <div class="taskSheet-detail ">
            <div class="task-info">
                <label for="userName">User Name :</label> <span class="text">{{$timer->user->name}}</span> <br>
                <label for="position">Position :</label> <span class="text">{{$timer->user->employee->position->title}}</span><br>
                <label for="startDate">Start Date :</label> <span class="text">{{$timer->task->started_at}}</span><br>
                <label for="endDate">End Date :</label> <span class="text">{{$timer->task->due_date??'-'}}</span><br>
                <label for="startTime">Start Time :</label> <span class="text">{{$timer->start_time}}</span><br>
            </div>
            <div class="tasktime-info">
                <label class="lb2" for="endTime">End Time :</label> <span class="text">{{$timer->end_time}}</span> <br>
                <label class="lb2" for="taskTitle">Task Title :</label> <span class="text">{{$timer->task->title}}</span><br>
                <label class="lb2" for="projecttitle">Project Time :</label> <span class="text">---</span><br>
                <label class="lb2" for="totalHours">Total Hours :</label> <span class="text">{{$timer->duration??'-'}}</span><br>
            </div>

        </div>

        <div class="form-row">
            <label for="comment" class="mt-4"> Comment on the Time Sheet</label>
            <textarea class="form-control" value="{{ old('comment') }}" name="comment" id="comment" cols="30" rows="5"
                placeholder="---------------"></textarea>
        </div>

    </div>
@stop

@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')



@stop
