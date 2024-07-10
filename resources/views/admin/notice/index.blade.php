@extends('adminlte::page')

@section('title', 'Notice')


@section('css')

    <style>
        .header-content {
            color: Blue;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            font-size: 24px;
            line-height: 36px;
            font-weight: 500;
            border-bottom: 1px solid #D5D5D5;
        }

        .icon {
            background-color: #D5D5D5;
            padding: 9px;
            border-radius: 50%;
            font-size: 20px
        }

        .notice-section {
            width: 900px;
            margin-top: 40px;
            margin-left: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .notice-box {
            position: relative;
            width: 430px;
            border: 1px solid#D5D5D5;
            font-size: 15px;
            padding: 20px;
            border-radius: 8px;
            /* overflow: hidden; */
            overflow: ;
        }

        .notice-header {

            display: flex;
            justify-content: space-between;
            gap: 10px;
            border-bottom: 1px solid #D5D5D5;
        }

        .notice-info p {
            padding-top: 10px;
        }

        .notice-header .title {
            color: #C2699E;
        }

        .notice-header .date {
            width: 170px;
        }

        .notice-view-btn {
            border: 0;
            border-radius: 8px;
            font-size: 15px;
            padding: 4px;
            color: white;
            background-color: #0466C8;
            float: right;
        }

        span.notice-view-btn {
            position: absolute;
            float: right;
            bottom: 10px;
            right: 10px;
            padding: 6px;

        }
    </style>
@endsection


@section('content')
<style>
    .action{
        display:flex;
        align-items: center;
    }
 
</style>

    @can('add-notice')

        <div class="row">
            <div class="col">
                {{--            <h1>Notice</h1> --}}
            </div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col pt-3 pb-3">
                <a href="{{ route('notice.create') }}" class="tertiary-color "><button type="button" class="btn btn-primary">Add
                        Notice</button></a>
            </div>
        </div>

        <div class="table-responsive ">
            <table class="table  data-table display table-bordered     ">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($notices as $notice)
                    <tr>
                        <td> {{ $loop->iteration }}</td>
                        <td class="col-3"> {{ $notice->title }}</td>
                        <td class="col-5"> {{ $notice->description }}</td>
                        <td> {{ $notice->date }}</td>
                        <td>
                           <div class="action">
                             <a href="{{ route('notice.show', $notice->id) }}" class="btn"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('notice.edit', $notice->id) }}" class="btn "><i class="far fa-edit"></i></a>
                            <form action="{{ route('notice.destroy', $notice->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"><i class="fas fa-trash-alt"
                                        style="color: #e01010;"></i></button>
                            </form>
                           </div>
                        </td>

                    </tr>
                @endforeach
                <tbody>

                </tbody>
            </table>
            {{ $notices->links() }}

        </div>
    @endcan

    @can('view-notice')

        </div>

        <div class="header-content">
            <div class="header">Notice Board</div>
            {{-- <div class="icon"><i class="fas fa-volume-up" style="color: #0466C8CC;"></i> </div> --}}
        </div>

        <div class="notice-section">
            @foreach ($notices as $notice)
                <div class="notice-box">
                    <div class="notice-header">
                        <div class="title">
                            {{ $notice->title }} </div>
                        <div class="date">
                            <i class="fas fa-calendar-alt"></i> {{ $notice->date }}
                        </div>
                    </div>
                    <div class="notice-info">
                        <p>
                            {!! Str::limit($notice->description, 100, '<span class="text-danger"> more...</span>') !!}
                        </p>
                    </div>
                    <div class="notice-button">
                        <a href="{{ route('notice.show', $notice->id) }}"> <span class="notice-view-btn">View
                                Details</span></a>
                    </div>
                </div>
            @endforeach
        @endcan


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
