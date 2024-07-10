@extends('adminlte::page')
@section('title', 'Emergency Contact')
@section('content_header')
    <div class="row">
        {{--    <div class="col"><h1>Emergency</h1></div> --}}
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        {{-- <div class="col"><a href="{{ route('emergency.create') }}" class="tertiary-color"><button type="button"
                    class="btn btn-primary">Add Emergency</button></a></div> --}}
    </div>

    <style>
        .setting-tab .b3 span {
            border-bottom: 2px solid #0466C8;
            padding-bottom: 6px;
        }
    </style>



@section('content')
    <div class="setting-container">
        <div class="setting-tab">
            <a class="b1" href="{{ route('setting.index') }}">Profile</a>
            <a class="b2" href="{{ route('emergency.index') }}">Emergency Contact</a>
            <a class="b3" href="{{ route('changepassword.index') }}"><span>Change Password</span></a>
            <div class="user-icon float-right pr-30">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>



    <div class="password-change-box">

        <div class="password-info">
            <div class="pass-head d-flex ">
                <div class="pass-text text-center">Change Password</div>
                <i class="fas fa-lock"></i>
            </div>

            <div class="pass-info">
                <p>Your password must be at least six characters and should include
                    a combination of numbers, letters and special characters (!$@%).</p>
            </div>
            
            <form action="{{ route('changepassword.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="combo-input">
                    <input type="password" class="form-control mt-3" placeholder="Current password" id="current_password"
                        value="{{ old('current_password') }}" name="current_password">
                    <input type="password" class="form-control mt-3 " placeholder="New Password" id="new_password"
                        value="{{ old('new_password') }}" name="new_password">
                    <input type="password" value="{{ old('confirm_password') }}" class="form-control mt-3 "
                        placeholder="New Password" id="confirm_password" name="confirm_password">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Change Password</button>


            </form>

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/changepw.css">
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
