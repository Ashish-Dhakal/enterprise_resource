@extends('adminlte::page')

@section('title', 'Time Sheet')

@section('content_header')
    <div class="row">
        {{--    <div class="col"><h1>Task</h1></div> --}}
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
    </div>
    <style>
        .text {
            color: #023E7D;
            align-items: center;
        }

        .timesheet-export {
            border: 1px solid #B6B6B6;
            color: #C2699E;
        }
    </style>


@stop

@section('content')
    <div class="container">

        <button class=" btn timesheet-export">Export <i class="fas fa-file-export" style="color: #C2699E;"></i> </button>

        <div class="table-responsive mt-5 bg-white">
            <table class="table table-md data-table rounded">

                <tr>
                    <th> ID</th>
                    <th>Emp Name</th>
                    <th>Task Title</th>
                    <th>Date</th>
                    {{-- <th>Time</th> --}}
                    {{-- <th>Hour Logged</th> --}}
                    <th>Hour Logged</th>
                    <th>Action</th>
                </tr>

                <tbody>
                    @foreach ($timers as $timer)
                        <tr>
                            <td>{{ $timer->id }}</td>
                            <td>{{ $timer->user->name }}</td>
                            <td>{{ $timer->task->title }}</td>
                            <td>{{ $timer->task->given_date }}</td>
                            <td>{{ $timer->duration }}</td>
                            <td>
                                <a href="{{ route('timeSheet.show', $timer->id) }}" class="btn"><i class="fas fa-eye"></i></a>
                                {{-- <a href="{{ route('timeSheet.ed    it') }}" class="btn "><i class="far fa-edit"></i></a> --}}

                            </td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <th class="text">01</th>
                        <th class="text"> Ramesh </th>
                        <th class="text">task title 1</th>
                        <th class="text">12/03/2020</th>
                        <th class="text">04:00 pm</th>
                        <th class="text">90 hr 20 min</th>
                        <td>
                            <a href="{{ route('timeSheet.show') }}" class="btn"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('timeSheet.edit') }}" class="btn "><i class="far fa-edit"></i></a>

                        </td>
                    </tr> --}}

                    {{-- <tr>
                        <th class="text">02</th>
                        <th class="text"> Ramesh </th>
                        <th class="text">task title 1</th>
                        <th class="text">12/03/2020</th>
                        <th class="text">04:00 pm</th>
                        <th class="text">90 hr 20 min</th>
                        <td>
                            <a href="" class="btn"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('timeSheet.edit') }}" class="btn "><i class="far fa-edit"></i></a>
                        </td>
                    </tr> --}}

                </tbody>


                <tbody>


                </tbody>
            </table>

        </div>


    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')

        <script>
            @if (Session::has('message'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ session('message') }}");
            @endif

            @if (Session::has('error'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ session('error') }}");
            @endif
        </script>


    @stop
