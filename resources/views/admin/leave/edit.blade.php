@extends('adminlte::page')

@section('title', 'Edit Leave')

<!-- @section('content_header')


@stop -->

@section('content')

    @if ($errors->any())

        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach

    @endif
    <div class="container ">
        <form action="{{ route('leave.update', $leave->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row ">
                <div class="form-group col-md-4 mt-4">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name" value="{{ $leave->user->name }}" name="name"
                        required placeholder="" readonly>
                    <input type="text" id="user_id" value="{{ $leave->user_id }}" name="user_id" hidden>
                </div>
                <div class="form-group col-md-4 mt-4">
                    <label for="type">Leave Type *</label>
                    <select class="form-control" id="type" name="type" required readonly>
                        <option value="{{ $leave->type }}">{{ $leave->type }}</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="paid">Paid</option>
                        <option value="annual">Annual</option>
                    </select>
                </div>
                <div class="form-group col-md-4 mt-4">
                    <label for="duration">Select Duration *</label>
                    <select class="form-control" id="duration" name="duration" required readonly>
                        <option value="{{ $leave->duration }} ">{{ $leave->duration }} </option>
                        <option value="half day">Half Day</option>
                        <option value="full day">Full Day</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="date">Date *</label>
                    <input type="date" class="form-control" id="date" value="{{ $leave->date }}" name="date"
                        readonly required>
                </div>

                <div class="form-group col-md-4">
                    <label for="duration">Status *</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">{{ $leave->status }} </option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>

                    </select>
                </div>
            </div>

            <div class="form-row">
                <label for="reason"> Reason *</label>
                <textarea class="form-control" name="reason" id="reason" cols="30" rows="5" readonly> {{ $leave->reason }} </textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Update</button>
            <a href="{{ route('leave.index') }}"><button type="submit" class="btn btn-secondary mt-4">Back</button></a>
        </form>
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
