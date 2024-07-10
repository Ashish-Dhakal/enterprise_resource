@extends('adminlte::page')

@section('title', 'Add Appreciation')

<!-- @section('content_header')

@stop -->

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('appreciation.store') }}" method="post" enctype="multipart/form-data">
            @csrf



            <div class="form-row">
                <div class="form-group col-md-6 mt-3">
                    <label for="employee_id">Employee *</label>
                    <select class="form-control" id="employee_id" name="employee_id" required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6 mt-3">
                    <label for="title">Title *</label>
                    {{-- <input type="text" class="form-control" id="title" name="title" required> --}}
                    <select class="form-control" id="title" name="title" required>
                        <option value="Employee Of Week">Employee of the Week</option>
                        <option value="Employee Of Month">Employee of the Month</option>
                        <option value="Intern of Week">Intern of the Week</option>
                        <!-- Add more options if needed -->
                    </select>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6 mt-3">
                    <label for="given_date">Given Date *</label>
                    <input type="date" class="form-control" id="given_date" name="given_date" value="{{old('given_date')}}" required
                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

    </div>

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
