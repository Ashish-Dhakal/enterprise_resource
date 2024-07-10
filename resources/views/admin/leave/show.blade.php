@extends('adminlte::page')

@section('title', 'View Leave')

@section('content_header')

@stop

@section('content')
    {{-- <div class="container">
        <div class="card-body">
            <h4> Name: {{$leave->name}}</h4>
            <h4>Type: {{$leave->type}}</h4>
            <h4>Duration: {{$leave->duration}}</h4>
            <h4>Date: {{$leave->date}}</h4>
            <h4>Reason: {{$leave->reason}}</h4>
            <h4>Status: {{$leave->status}}</h4>
        </div>
        <a href="{{route('leave.index')}}">
            <div class="button">
                <button class="btn btn-primary" type="submit">Back</button>
            </div></a>
    </div> --}}

    <div class="container">
        <div class="button">
            <span>Export <i class="fas fa-file-export pl-1"></i></span>
        </div>

        <div class="heading">Leave Details</div>

        <div class="leave-container mt-4">

            <div class="container_one">
                <label for="name">Applicant Name:</label> <span> <img
                        src="/uploads/employee/{{ $leave->user->employee?->image }}" alt="Employee Image"
                        style="height: 40px; width:40px;"> {{ $leave->user->employee?->first_name }}
                    {{ $leave->user->employee?->last_name }}</span> <br>
                <label for="position">Position:</label> <span>{{ $leave->user->employee?->position->title }}</span> <br>
                <label for="appliedDate">Applied Date:</label> <span>{{ $leave->date }}</span> <br>
                <label for="status">Status:</label> <span>{{ $leave->status }}</span> <br>
            </div>

            <div class="container_two">
                <label for="leaveDuration">Leave Duration:</label> <span>{{ $leave->duration }}</span> <br>
                <label for="leaveType">Leave Type:</label> <span>{{ $leave->type }}</span> <br>
            </div>

            
        </div>
         <div class="form-row mt-4">
                    <label for="reason"> Reason *</label>
                    <textarea class="form-control" value="" name="reason" id="reason" cols="30" rows="5"
                        placeholder="{{ $leave->reason }}" readonly></textarea>
                </div>





    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
