@extends('adminlte::page')

@section('title', 'View Attendance')

@section('content_header')

@stop

@section('content')


    <div class="container">
        <div class="button">
            <span>Export <i class="fas fa-file-export pl-1"></i></span>
        </div>

        <div class="heading">Attendance Details</div>

        <div class="userInfo mt-4">
            <div class="user-detail">
                <div class="image">
                    <img src="/uploads/employee/{{ $attendances->user->employee->image}}" alt="Employee Image"> 
                </div>
                <div class="info">
                     {{$attendances->user->employee->first_name}} {{$attendances->user->employee->last_name}} <br> {{$attendances->user->employee->position->title}}

                </div>
            </div>

            <div class="dialog-box d-flex">
                <div class="icon p-4" style="color: #C2699E">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="message pr-3">
                    Check Your Attendance: Dive into Attendance Details and Stay Connected!
                </div>
            </div>

        </div>

        <div class="timeInfo mt-4">
            
            <div class="date mb-4">
                Date:{{$attendances->date}}
            </div>

            <div class="clock-in-out mt-3 d-flex justify-content-between">
                <div class="clock"><span>Clock in :</span> <i class="fas fa-circle fa-rotate-by" style="color: #00B628; --fa-rotate-angle: 00628deg;"></i> {{$attendances->clock_in_time}}</div>
                <div class="clock"><span>Clock out :</span> <i class="fas fa-circle fa-rotate-by" style="color: #C2699E; --fa-rotate-angle: 00628deg;"></i> {{$attendances->clock_out_time}}</div>
            </div>



             <div class="timePeriod d-flex mt-4 align-items-center">
            Time Period

            <div class="duration">
                <div class="time">
                    {{$attendances->work_hrs}}
                </div>
            </div>
        </div>  

        </div>

       


    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/user_attendance.css">
@stop

@section('js')
@stop
