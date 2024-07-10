@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
    <div class="row">
        <div class="col">
            {{--            <h1>Employee</h1> --}}
        </div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"><a href="{{ route('employee.create') }}" class="tertiary-color"><button type="button"
                    class="btn btn-primary">Add Employee</button></a></div>
    </div>


@stop

@section('content')

<style>
    .action{
        display:flex;
        align-items: center;
    }
 
</style>
    <div class="table-responsive ">
        <table class="table  data-table display table-bordered     ">
            <thead>
                <tr>
                    <th>SN.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Hire Date</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($employees as $employee)
                <tr>
                    <td> {{ $loop->iteration}}</td>
                    <td> {{ $employee->first_name }}</td>
                    <td> {{ $employee->last_name }}</td>
                    <td> {{ $employee->dob }}</td>
                    <td> {{ $employee->gender }}</td>
                    <td> {{ $employee->number }}</td>
                    <td> {{ $employee->email }}</td>
                    <td> {{ $employee->address }}</td>
                    <td> {{ $employee->hire_date }}</td>
                    <td> {{ $employee->position_id }}</td>
                    <td>
                       <div class="action">
                         <a href="{{ route('employee.show', $employee->id) }}" class="btn"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn "><i
                                class="far fa-edit"></i></a>
                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
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
        {{ $employees->links() }}

    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> 
@stop

@section('js')
<script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  
</script>

    {{-- <script>
    $(function () {
            var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employee.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'dob', name: 'dob' },
                { data: 'gender', name: 'gender' },
                { data: 'number', name: 'number' },
                { data: 'email', name: 'email' },
                { data: 'address', name: 'address' },
                { data: 'hire_date', name: 'hire_date' },
                { data: 'position_id', name: 'position.title' },
                { data: 'action', name: 'action', orderable: false, searchable: false },


            ]
        });
    });
</script> --}}
@stop
