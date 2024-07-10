@extends('adminlte::page')

@section('title', 'Add Notice')

{{-- <!-- @section('content_header') --}}
{{--    <h1>Add Notice</h1>   --}}

{{-- @stop --> --}}

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">
        <form action="{{ route('notice.store') }}" method="post" enctype="multipart/form-data">
            @csrf


            <div class="form-row">
                <div class="form-group col-md-5 mt-3">
                    <label for="title">Title *</label>
                    <input type="text" class="form-control" value="{{ old('title') }}" id="title" name="title"
                        required>
                </div>

                <div class="form-group col-md-5 mt-3">
                    <label for="date">Date *</label>
                    <input type="date" class="form-control" value="{{ old('date') }}" id="date" name="date"
                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="description">Description *</label>

                    <textarea class="form-control" value="{{ old('description') }}" name="description" id="description" cols="30"
                        rows="4"></textarea>
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
