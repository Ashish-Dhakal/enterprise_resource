@extends('adminlte::page')

@section('title', 'Edit Position')

<!-- @section('content_header')


@stop -->

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('position.update', $position->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6 mt-4">
                    <label for="title">Title *</label>
                    <input type="text" class="form-control" id="title" value="{{ $position->title }}" name="title"
                        required>
                </div>

                <div class="form-group col-md-6 mt-4">
                    <label for="department_id">Department *</label>

                    <select class="form-control" id="department_id" name="department_id" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->title }} ({{ $department->title }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2 mt-2">Update</button>
            <a href="{{ route('position.index') }}"><button type="submit" class="btn btn-secondary mt-2">Back</button></a>

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
