@extends('adminlte::page')

@section('title', 'Edit Salary')

<!-- @section('content_header')
@stop -->

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('salary.update', $salary->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">

                <div class="form-group col-md-6 mt-3">
                    <label for="employee_id">Employee *</label>
                    {{-- <select class="form-control" id="employee_id" name="employee_id" required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }}
                            </option>
                        @endforeach
                    </select> --}}
                    <input type="text" class="form-control" value="{{ $salary->employee->first_name }}" id="amount"
                        name="amount">
                </div>

                <div class="form-group col-md-6 mt-3">
                    <label for="amount">Amount *</label>
                    <input type="number" class="form-control" value="{{ $salary->amount }}" id="amount" name="amount"
                        required>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6 mt-3">
                    <label for="effective_date">Effective Date *</label>
                    <input type="date" class="form-control" id="effective_date" value="{{ $salary->given_date }}"
                        name="effective_date" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
    </div>


    {{-- <a href="{{ route('employee.index') }}"><button type="submit" class="btn btn-secondary">Back</button></a> --}}
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
