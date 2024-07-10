@extends('adminlte::page')

@section('title', 'Edit Notice')

<!-- @section('content_header')

@stop -->

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('notice.update', $notice->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-5 mt-3">
                    <label for="title"> Title *</label>
                    <input type="text" class="form-control" id="title" value="{{ $notice->title }}" name="title"
                        required>
                </div>

                <div class="form-group col-md-5 mt-3">
                    <label for="date"> Date *</label>
                    <input type="date" class="form-control" id="date" value="{{ $notice->date }}" name="date"
                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>


            </div>
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="description">Description *</label>

                    <textarea class="form-control" name="description" id="description" cols="30" rows="4">{{ $notice->description }}</textarea>
                </div>
            </div>





            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('notice.index') }}"><button type="submit" class="btn btn-secondary">Back</button></a>
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
