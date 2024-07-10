@extends('adminlte::page')

@section('title', 'Add Employee')

{{-- <!-- @section('content_header') --}}
{{--    <h1>Add Employee</h1>   --}}

{{-- @stop --> --}}

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6 mt-3">
                    <label>
                        Employee Details:
                    </label>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="first_name">First Name*</label>
                    <input type="text" value="{{ old('first_name') }}" class="form-control" id="first_name"
                        name="first_name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last Name*</label>
                    <input type="text" value="{{ old('last_name') }}" class="form-control" id="last_name"
                        name="last_name" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date_of_birth">Date of Birth*</label>
                    <input type="date" value="{{ old('date_of_birth') }}" class="form-control" id="dob"
                        name="dob" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="gender">Gender*</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <!-- Add more options if needed -->
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contact_number">Contact Number*</label>
                    <input type="text" value="{{ old('contact_number') }}" class="form-control" id="number"
                        name="number" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="position_id">Position *</label>
                    <select class="form-control" id="position_id" name="position_id" required>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->title }} ({{ $position->department->title }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="hire_date">Hire Date*</label>
                    <input type="date" value="{{ old('hire_date') }}" class="form-control" id="hire_date"
                        name="hire_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="address">Address*</label>
                    <textarea class="form-control" value="{{ old('address') }}" id="address" name="address" rows="1" required></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 mb-0 mt-2">
                    <label>
                        Account Details:
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email*</label>
                    <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email"
                        required>
                </div>

                {{-- <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" value="{{old('password')}}"  class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group col-md-6">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" value="{{old('password_confirmation')}}"  id="password_confirmation" name="password_confirmation" required>
            </div> --}}



            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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


