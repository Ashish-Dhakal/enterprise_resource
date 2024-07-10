@extends('adminlte::page')

@section('title', 'Salary')

@section('content_header')
    <div class="row">
        {{--    <div class="col"><h1>Salary</h1></div> --}}
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"><a href="{{ route('salary.create') }}" class="tertiary-color"><button type="button"
                    class="btn btn-primary">Add Salary</button></a></div>
    </div>


@stop

@section('content')

<style>
    .action{
        display:flex;
        align-items: center;
    }
 
</style>
    <div class="container">
        <table class="table table-bordered" id="employee-table">
            <thead>
                <tr>
                    <th>Salary N0.</th>
                    <th>Employee Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($salaries as $salary)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $salary->employee->first_name }}</td>
                        <td>{{ $salary->amount }}</td>
                        <td>{{ $salary->effective_date }}</td>
                        <td>
                          <div class="action">
                              <a href="{{ route('salary.show', $salary->id) }}" class="btn"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('salary.edit', $salary->id) }}" class="btn "><i class="far fa-edit"></i></a>
                            <form action="{{ route('salary.destroy', $salary->id) }}" method="POST">
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
        {{ $salaries->links() }}

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
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('leave.index') }}",
                columns: [
                    {data: 'id', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data, type, full, meta) {
                            // Assuming 1 represents active and 0 represents inactive
                            return data == 1 ? 'Active' : 'Inactive';
                        }},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ],
            });
        });
    </script> --}}
@stop
