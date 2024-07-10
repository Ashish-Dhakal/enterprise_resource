@extends('adminlte::page')

@section('title', 'Edit Project')

<!-- @section('content_header')

@stop -->

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
     <div class="container ">
        <form action="{{ route('project.update', $project->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="form-row ">
                <div class="form-group col-md-6 mt-3">
                    <label for="title">Project Title *</label>
                    <input type="text" class="form-control" value="{{$project->title}}" id="title" name="title" required>
                </div>
                <div class="form-group col-md-6 mt-3">
                    <label for="title">Project Member *</label>
                    <select  class="form-control" id="employee_id" name="employee_ids[]" required multiple>
                        @foreach ($employees as $employee) employees
                        <option value="{{ $employee->id }}">{{ $employee->first_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md">
                    <label for="description">Project Description *</label>
                    <textarea class="form-control"  name="description" id="description" cols="30" rows="4">{{$project->description}}</textarea>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-6 ">
                    <label for="started_at">Started Date *</label>
                    <input type="date" class="form-control" id="started_at" value="{{$project->started_at}}" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" name="started_at" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="deadline_at">Deadline Date *</label>
                    <input type="date" class="form-control" id="deadline_at" value="{{$project->deadline_at}}" name="deadline_at" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                </div>
            </div>

            {{-- <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="completion_time">Completion Time</label>
                    <input type="time" class="form-control" id="completion_time" value="{{$project->completion_time}}" name="completion_time" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="completion_at">Completed Date</label>
                    <input type="date" class="form-control" id="completion_at" value="{{$project->completion_at}}"  name="completion_at" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                </div>
            </div> --}}

            {{--
            title
        description
        started_at
        deadline_at
        completion_time
        completed_at
        --}}


            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('employee.index') }}"><button type="submit" class="btn btn-secondary">Back</button></a>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('employee_id')  // id
    </script>
@stop
