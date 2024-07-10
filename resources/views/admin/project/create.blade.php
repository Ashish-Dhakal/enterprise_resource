@extends('adminlte::page')

@section('title', 'Add Project')

<!-- @section('content_header')

@stop -->

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-row ">
                <div class="form-group col-md-6 mt-3">
                    <label for="title">Project Title *</label>
                    <input type="text" value="{{ old('title') }}" class="form-control" id="title" name="title"
                        required>
                </div>

                <div class="form-group col-md-6 mt-3">
                    <label for="title">Project Member *</label>
                    <select class="form-control" id="employee_id" name="employee_ids[]" required multiple>
                        @foreach ($employees as $employee)
                            employees
                            <option value="{{ $employee->id }}">{{ $employee->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-md">
                    <label for="description">Project Description *</label>
                    {{--                    <textarea class="form-control" value="{{old('description')}}" name="description" id="description" cols="30" rows="4"></textarea> --}}
                    <textarea class="form-control" id="description" name="description" cols="30" rows="4" required>{{ old('description') }}</textarea>

                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-6 ">
                    <label for="started_at">Started Date *</label>
                    <input type="date" value="{{ old('started_at') }}" class="form-control" id="started_at"
                        name="started_at" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="deadline_at"> Deadline Date *</label>
                    <input type="date" value="{{ old('deadline_at') }}" class="form-control" id="deadline_at"
                        name="deadline_at" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>
            </div>

            {{-- <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="completion_time"> Completion Time </label>
                    <input type="time" value="{{old('completion_time')}}" class="form-control" id="completion_time" name="completion_time" >
                </div>
                <div class="form-group col-md-6">
                    <label for="completion_at">Completed Date</label>
                    <input type="date" class="form-control" value="{{old('completion_at')}}" id="completion_at" name="completion_at" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                </div>
            </div> --}}




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
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('employee_id') // id
    </script>
@stop
