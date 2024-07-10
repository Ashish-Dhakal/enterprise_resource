@extends('adminlte::page')

@section('title', 'Department')

@section('content')

<style>
    .action{
        display:flex;
        align-items: center;
    }
 
</style>
    <div class="row mx-4 py-3">
        <a href="{{ route('department.create') }}" class="tertiary-color">
            <button type="button"
                    class="btn btn-primary rounded">Add Department +
            </button>
        </a>

        <div class="table-responsive mt-5 bg-white">
            <table class="table table-md data-table rounded data-table display table-bordered" >
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $department->title }}</td>
                        <td>
                           <div class="action">
                             <a href="{{ route('department.show', $department->id) }}" class="btn"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('department.edit', $department->id) }}" class="btn "><i
                                    class="far fa-edit"></i></a>
                            <form action="{{ route('department.destroy', $department->id) }}" method="POST">
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
            {{$departments->links()}}

        </div>

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

@stop
