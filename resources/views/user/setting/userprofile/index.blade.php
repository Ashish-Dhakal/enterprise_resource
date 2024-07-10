@extends('adminlte::page')
@section('title', 'Setting')
@section('content_header')
    <div class="row">
        {{--    <div class="col"><h1>Appreciation</h1></div> --}}
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        {{-- <div class="col"><a href="{{ route('appreciation.create') }}" class="tertiary-color"><button type="button"
                    class="btn btn-primary">Add Appreciation</button></a></div> --}}
    </div>

    <style>
        .setting-tab .b1 span {
            border-bottom: 2px solid #0466C8;
            padding-bottom: 6px;
        }
    </style>


@section('content')
    <div class="setting-container">
        <div class="setting-tab">
            <a class="b1" href="{{ route('setting.index') }}"><span>Profile</span></a>
            <a class="b2" href="{{ route('emergency.index') }}">Emergency Contact</a>
            <a href="{{ route('changepassword.index') }}">Change Password</a>
            <div class="user-icon float-right pr-30">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    <div class="user-content">
        <div class="form">
            <form action="{{ route('setting.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')



                <div class="user-info">


                    @if ($user->employee?->image)
                        <div class="image-side">
                            <div class="user-image">
                                <img src="uploads/employee/{{ $user->employee?->image ?? ''  }}" alt="{{ $user->name }} ppimage">
                                <br>
                                <div class="pt-2 text-center " style="color: #C2699E">Profile Pic</div>
                            </div>
                        </div>
                    @else
                        <div class="image-side">
                            <div class="user-image">
                                <!-- Input field for uploading image -->
                                <input type="file" name="image" accept="image">
                            </div>
                        </div>
                    @endif



                    {{-- <div class="image-side">
                        <div class="user-image">
                            <img src="img/user.jpeg" alt=""> <br>
                            <div class="pr-9 pt-2" style="color: #C2699E">Profile Image</div>
                        </div>
                    </div> --}}

                    <div class="form-side">
                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="name">Your Name <span style="color: #FF3B30">*</span> </label>
                                <input type="text" value="{{ $user->name }}" class="form-control" id="first_name"
                                    name="first_name" readonly>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="position">Your Position <span style="color: #FF3B30">*</span> </label>
                                <input type="text" value="{{ $user->employee->position?->title ?? ''}}" class="form-control"
                                    id="position" name="position" readonly>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="hobbies">Hobbies <span style="color: #FF3B30">*</span></label>
                                <input type="text"
                                    value=" {{ $user->employee && $user->employee->personaldetail ? $user->employee->personaldetail['hobbies'] : '' }}"
                                    class="form-control" id="hobbies" name="hobbies" required>


                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="first_name">Gender <span style="color: #FF3B30">*</span> </label>
                                {{-- <select class="form-control" id="gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option> --}}
                                </select>
                                <input type="text" value="{{ $user->employee?->gender }}" class="form-control"
                                    id="gender" name="gender" readonly>

                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="last_name">DOB <span style="color: #FF3B30">*</span> </label>
                                <input type="date" value="{{ $user->employee?->dob }}" class="form-control"
                                    id="dob" name="dob" required>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="number">Contact Number <span style="color: #FF3B30">*</span></label>
                                <input type="number" value="{{ $user->employee?->number }}" class="form-control"
                                    id="number" name="number" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="email">Your email <span style="color: #FF3B30">*</span> </label>
                                <input type="text" value="{{ $user->email }}" class="form-control" id="email"
                                    name="email" readonly>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="country">Country <span style="color: #FF3B30">*</span> </label>
                                {{-- <select class="form-control selectpicker countrypicker" data-flag="true"></select> --}}
                                <input type="text"
                                    value=" {{ $user->employee && $user->employee->personaldetail ? $user->employee->personaldetail['country'] : '' }}"
                                    class="form-control" id="country" name="country" required>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="language">Language <span style="color: #FF3B30">*</span></label>
                                <input type="text"
                                    value=" {{ $user->employee && $user->employee->personaldetail ? $user->employee->personaldetail['language'] : '' }}"
                                    class="form-control" id="language" name="language" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="city">Your City <span style="color: #FF3B30">*</span> </label>
                                <input type="text"
                                    value=" {{ $user->employee && $user->employee->personaldetail ? $user->employee->personaldetail['city'] : '' }}"
                                    class="form-control" id="city" name="city" required>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="postalcode">Postal Code / Ward <span style="color: #FF3B30">*</span> </label>
                                <input type="text"
                                    value=" {{ $user->employee && $user->employee->personaldetail ? $user->employee->personaldetail['postalcode'] : '' }}"
                                    class="form-control" id="postalcode" name="postalcode" required>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="last_name">Enable Google Calender</label> <br>
                                <input type="radio" id="yes" name="goog_cal" value="yes">YES
                                <input type="radio" id="no" name="google_cal" value="css">NO
                            </div>
                        </div>


                    </div>


                </div>


                <div class="form-row about-you">
                    <label for="about-you"> About You</label>
                    <textarea class="form-control" name="about-you" id="about-you" cols="30" rows="5">  {{ $user->employee && $user->employee->personaldetail ? $user->employee->personaldetail['about-you'] : '' }}</textarea>
                </div>


                <button type="submit" class="btn btn-primary float-right mt-3">Edit</button>
        </div>

        </form>

    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/user_setting.css">

    <script src="
            https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js
            "></script>


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
