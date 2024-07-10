@extends('adminlte::page')

@section('title', 'Add Task')

<!-- @section('content_header')

@stop -->

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('task.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-row">

                <div class="form-group col-md-6 mt-3">
                    <label for="title">Title *</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                        required>
                </div>

                <div class="form-group col-md-6 mt-3">
                    <label for="project_id">Project *</label>
                    <select class="form-control" id="project_id" name="project_id" required>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}
                            </option>
                        @endforeach
                    </select>
                </div>


            </div>

            <div class="form-row">
                <div class="form-group col-md-6 mt-3">
                    <label for="employee_id">Project Member *</label>
                    <select class="form-control" id="employee_id" name="employee_ids[]" multiple="multiple" required>
                    </select>
                </div>
                <div class="form-group col-md-6 mt-3">
                    <label for="given_date">Given Date *</label>
                    <input type="date" class="form-control" id="given_date" name="given_date"
                        value="{{ old('given_date') }}" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
            </div>

            <div class="form-row">
                <label for="description"> Description *</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="4">{{ old('description') }}</textarea>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6 mt-3">
                    <label for="started_at">Started At *</label>
                    <input type="date" class="form-control" id="started_at" name="started_at"
                        value="{{ old('started_at') }}" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>


                <div class="form-group col-md-6 mt-3">
                    <label for="deadline">Deadline *</label>
                    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline') }}"
                        required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
            </div>

            {{-- <div class="form-row">
                <div class="form-group col-md-6 mt-3">
                    <label for="completed_at">Completed At</label>
                    <input type="date" class="form-control" id="completed_at" name="completed_at"
                        value="{{ old('completed_at') }}" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>

                <div class="form-group col-md-6 mt-3">
                    <label for="time_taken">Time Taken</label>
                    <input type="time" class="form-control" id="time_taken" name="time_taken"
                        value="{{ old('time_taken') }}" required>
                </div>
            </div> --}}
            <button type="submit" class="btn btn-primary mb-3">Submit</button>

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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            var projectSelect = $('#project_id');
            var employeeSelect = $('#employee_id');

            projectSelect.on('change', function() {
                var projectId = projectSelect.val();
                employeeSelect.empty();

                @foreach ($projectMembers as $projectMember)
                    if ("{{ $projectMember->project_id }}" == projectId) {
                        var option = $('<option></option>');
                        option.val("{{ $projectMember->employee_id }}");
                        option.text("{{ $projectMember->employee->first_name }}");
                        employeeSelect.append(option);
                    }
                @endforeach
            });

            projectSelect.trigger('change');
        });


        $('#employee_id').select2({
            placeholder: 'select member',
            allowClear: true
        });
    </script>


@stop
