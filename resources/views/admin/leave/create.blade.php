@extends('adminlte::page')

@section('title', 'Add Leave')

<!-- @section('content_header')
            {{--                    <h1>Add Employee</h1> --}}

@stop -->


@section('content')


    <style>

    </style>


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <div class="card-layout">
            <div class="assign-leave" style="font-size:20px; padding:10px 0 10px 0">
                <div class="back-icon ">
                    <a href="{{ route('leave.index') }}"><i class="far fa-arrow-alt-circle-left "></i> <span class="pr-10">
                            Assign Leave</span></a>
                </div>
            </div>
            <hr>

            <form action="{{ route('leave.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{ old('') }}
                <div class="form-row ">
                    <div class="form-group col-md-4">
                        <label for="name">Name *</label>
                        <input type="text" class="form-control" id="name" value="{{ $user->name }}" name=""
                            readonly placeholder="{{ $user->name }}">
                        <input type="text" id="user_id" value="{{ $user->id }}" name="user_id" hidden>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="type">Leave Type*</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">Select Leave Type *</option>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                            <option value="annual">Annual</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="duration">Select Duration *</label>
                        <select class="form-control" id="duration" name="duration" required>
                            <option value="">Select Duration</option>
                            <option value="halfDay">Half Day</option>
                            <option value="fullDay">Full Day</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date">Date *</label>
                        <input type="date" class="form-control" id="date" value="{{ old('date') }}" name="date"
                            required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                </div>

                <div class="form-row">
                    <label for="reason"> Reason *</label>
                    <textarea class="form-control" value="{{ old('reason') }}" name="reason" id="reason" cols="30" rows="5"
                        placeholder="For eg :Feeling not well"></textarea>
                </div>
                <div class="action mt-4">
                    <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"
                            style="padding-left: 10px"></i></button>
                    <button type="submit" class="btn btn-primary">Cancel</button>
                </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->

    </body>

    </html>
@stop

@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- <script>
        console.log('Hi!');
    </script> -->
@stop
