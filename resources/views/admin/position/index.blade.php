@extends('adminlte::page')

@section('title', 'Position')

@section('content_header')
    <div class="row">
        <div class="col">
{{--            <h1>Position</h1>--}}
        </div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"><a href="{{ route('position.create') }}" class="tertiary-color"><button type="button"
                    class="btn btn-primary">Add Position</button></a></div>
    </div>


@stop

@section('content')

<style>
    .action{
        display:flex;
        align-items: center;
    }
 
</style>
    <div class="table-responsive">
        <table class="table  data-table display table-bordered ">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($positions as $position)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $position->title }}</td>
                        <td>{{ $position->department?->title }}</td>
                        <td>
                         <div class="action">
                               <a href="{{ route('position.show', $position->id) }}" class="btn"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('position.edit', $position->id) }}" class="btn "><i class="far fa-edit"></i></a>
                            <form action="{{ route('position.destroy', $position->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"><i class="fas fa-trash-alt" style="color: #e01010;"></i></button>
                            </form>
                         </div>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
        {{$positions->links()}}
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

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
            ajax: "{{ route('position.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'department_id', name: 'department.title' },
                { data: 'action', name: 'action', orderable: false, searchable: false },


            ]
        });
    });
</script> --}}
@stop
