@extends('adminlte::page')

@section('title', 'Leave')

@section('content')
<style>
    .action{
        display:flex;
        align-items: center;
    }
 
</style>

    @can('user-leave-index')
        <div class="row mx-4 py-3">
            <a href="{{ route('leave.create') }}" class="tertiary-color">
                <button type="button" class="btn btn-primary rounded">Add Leave +
                </button>
            </a>

            <div class="table-responsive mt-5 bg-white">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            {{--                    <th>Employee Id</th> --}}
                            <th> Leave Date</th>
                            <th>Duration</th>
                            <th>Leave Type</th>
                            <th>Leave Reason</th>
                            <th>Leave Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr >
                                <td>{{ $leave->id }}</td>
                                 <td>
                                    @if ($leave->user && $leave->user->employee)
                                        <img src="/uploads/employee/{{ $leave->user->employee->image }}" alt="Employee Image"
                                            style="height: 50px; width:50px;">
                                    @else
                                        [No img]
                                    @endif {{ $leave->user->name }}
                                </td>       
                                <th>{{ $leave->date }}</th>
                                <th>{{ $leave->duration }}</th>
                                <th>{{ $leave->type }}</th>
                                <th>{{ $leave->reason }}</th>
                                <th>{{ $leave->status }}</th>
                                <td>
                                    <div class="action">
                                        <a href="{{ route('leave.show', $leave->id) }}" class="btn"><i class="fas fa-eye"></i></a>
            
                                        @can('admin-access')
                                         <a href="{{ route('leave.edit', $leave->id) }}" class="btn "><i
                                            class="far fa-edit"></i></a>
                                    <form action="{{ route('leave.destroy', $leave->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn"><i class="fas fa-trash-alt"
                                                style="color: #e01010;"></i></button>
                                    </form>
                                            
                                        @endcan
                                   
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{-- {{$leaves->links()}} --}}

            </div>

        </div>

    @endcan


    @can('admin-leave-index')
        <div class="row mx-4 py-3">
            <a href="{{ route('leave.create') }}" class="tertiary-color">
                <button type="button" class="btn btn-primary rounded">Add Leave +
                </button>
            </a>

            <div class="table-responsive mt-5 bg-white">
                <table  class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            {{--                    <th>Employee Id</th> --}}
                            <th> Leave Date</th>
                            <th>Duration</th>
                            <th>Leave Type</th>
                            <th>Leave Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($leave->user && $leave->user->employee)
                                        <img src="/uploads/employee/{{ $leave->user->employee->image }}" alt="Employee Image"
                                            style="height: 70px; width:70px;">
                                    @else
                                        [No img]
                                    @endif {{ $leave->user->name }}
                                </td>
                                <th>{{ $leave->date }}</th>
                                <th>{{ $leave->duration }}</th>
                                <th>{{ $leave->type }}</th>
                                <th>{{ $leave->status }}</th>
                                <td>
                                   <div class="action">
                                     <a href="{{ route('leave.show', $leave->id) }}" class="btn"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('leave.edit', $leave->id) }}" class="btn "><i
                                            class="far fa-edit"></i></a>
                                    <form action="{{ route('leave.destroy', $leave->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn"><i class="fas fa-trash-alt"
                                                style="color: #e01010;"></i></button>
                                    </form>
                                   </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{-- {{$leaves->links()}} --}}

            </div>

        </div>


    @endcan





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

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

    {{-- <script>
    $(function () {
            var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('department.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script> --}}
@stop
