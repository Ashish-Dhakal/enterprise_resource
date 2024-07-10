@extends('adminlte::page')

@section('title', 'Add Salary')

<!-- @section('content_header')

@stop -->

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('salary.store') }}" method="post" enctype="multipart/form-data">
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
                    <label for="amount">Amount *</label>
                    <input type="number" class="form-control" id="amount" name="amount" required>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-6 mt-3">
                    <label for="allowences">Allowences *</label>
                    <input type="number" class="form-control" id="allowences" name="allowences" required>
                </div>
                <div class="form-group col-md-6 mt-3">
                    <label for="deduction">deduction *</label>
                    <input type="number" class="form-control" id="deduction" name="deduction" required>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6 mt-3">
                    <label for="effective_date">Effective Date *</label>
                    <input type="date" class="form-control" id="effective_date" name="effective_date" required
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
