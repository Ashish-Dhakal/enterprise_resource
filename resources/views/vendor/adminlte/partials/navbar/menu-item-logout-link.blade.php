@php($logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout'))

@if (config('adminlte.use_route_url', false))
    @php($logout_url = $logout_url ? route($logout_url) : '')
@else
    @php($logout_url = $logout_url ? url($logout_url) : '')
@endif


@php($user = \Illuminate\Support\Facades\Auth::user())

<style>
    .modal-backdrop {
        z-index: 0 !important;
    }

    .alert {
        position: absolute;
        z-index: 1000;
        width: 300px;
        top: 6px;
        right: 5px;
    }

    .approve-box {
        padding-top: 50px;
        text-align: center;
        height: 180px;
        width: 250px;
        background-color: white;
        color: #C2699E;
        border-radius: 12px;
        box-shadow: 0px 2px 9px 4px rgba(150, 150, 150, 0.24)
    }

    /* .tick {
        margin-left: 90px;
        text-align: center;
        background-color: #D0E8FF;
        height: 60px;
        width: 60px;
        border-radius: 50%;

    }

    .tick i {
        font-size: 20px;
        margin: 10px 10px 10px 5px;
    } */


    /*a.nav-link.bell {*/
    /*    background-color: #e9ecef;*/
    /*    border-radius: 10px;*/
    /*    margin-right: 7px;*/
    /*    !* border: solid black 0.1px; *!*/
    /*}*/
</style>
{{-- <li class="nav-item pr-2"> --}}
{{--    <a class="btn btn-default btn-flat border rounded text-center m-auto p-auto"><i class="far fa-bell"></i></a> --}}
{{-- </li> --}}
<li class="nav-item pr-2">
    <a class="btn btn-default btn-flat border rounded text-center m-auto p-auto"><i
            class="fa fa-fw fa-calendar-alt"></i></a>
</li>

<li class="nav-item pr-2">

    <a class="btn btn-default btn-flat  border rounded float-right " href="#"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-fw fa-power-off text-red"></i>
    </a>
    <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
        @if (config('adminlte.logout_method'))
            {{ method_field(config('adminlte.logout_method')) }}
        @endif
        {{ csrf_field() }}
    </form>
</li>

{{-- @dd($attendance) --}}
@php(
    $attendance = \App\Models\Attendance::where('user_id', $user->id)->whereDate('date', \Carbon\Carbon::now())->first()
)
@if ($user->role == 'User')
    @if ($attendance && $attendance->status == 'pending')
        <li class="nav-item d-flex flex-column">
            <a class="btn btn-danger border-0 rounded float-right text-white p-auto m-auto" {{--  clock in change to clock out in route

                               --}}
                href="{{ route('clock-in', ['user_id' => $user->id]) }}">
                <i class="fa fa-fw pr-1 fa-clock"></i>Clock Out
            </a>
            {{--        <span><small>ClockIn:{{$attendance?->clock_in}}</small></span> --}}
        </li>
    @else
        <li class="nav-item">
            {{--             <a class="btn btn-primary border-0 rounded float-right text-white p-auto m-auto" --}}
            {{--                href="{{ route('clock-in', ['userId' => $user->id, 'clockIn' => true]) }}"> --}}
            {{--                <i class="fa fa-fw pr-1 fa-clock"></i>Clock In --}}
            {{--            </a> --}}

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Clock In
            </button>

            <!-- Modal -->






        </li>
    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Clock In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: flex; justify-content: space-between ">
                        <i class="far fa-clock">{{ \Carbon\Carbon::now()->format('h:m A') }}</i>
                        <span>{{ $user?->employee?->position?->title }}</span>
                    </div>


                    <form action="{{ route('clock-in') }}" method="get" enctype="multipart/form-data">

                        <div style="display: flex; justify-content: space-between">

                            <div class="form-group col-md-6 mt-3">
                                <label for="title">Location</label>
                                <select class="form-control" id="Location" name="location" required>
                                    <option value="Nayabazar,Pokhara">Nayabazar, Pokhara</option>
                                    <option value="Bagar">Bagar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="title">Working From</label>
                                <select class="form-control" id="source" name="source" required>
                                    <option value="Office">Office</option>
                                    <option value="Home">Home</option>
                                </select>
                            </div>
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                            <input type="hidden" value="true" name="clockIn">


                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Clock In</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    {{-- @if (session()->has('message'))
        <div class="alert" id="success-alert">
            {{-- {{ session()->get('message') }} --}}

    {{-- <div class="approve-box" >

                <div class="tick">
                    <i class="fas fa-check"></i>
                </div>

                <div class="succ-message mt-4">
                    {{ session()->get('message') }}
                </div>
            </div> --}}



    {{-- </div>
    @endif

    @if (session()->has('message2'))
        <div class="alert " id="danger-alert"> --}}
    {{--            {{ session()->get('message2') }} --}}

    {{-- <div class="approve-box" >

                <div class="tick">
                    <i class="fas fa-check"></i>
                </div>

                <div class="succ-message mt-4">
                    {{ session()->get('message2') }}
                </div>
            </div>

        </div>
        </div>
    @endif --}}

    {{-- @if (session()->has('message3'))
        <div class="alert " id="danger-alert"> --}}
    {{--            {{ session()->get('message2') }} --}}

    {{-- <div class="approve-box" >

                <div class="tick">
                    <i class="fas fa-times"></i>
                </div>

                <div class="succ-message mt-4">
                    {{ session()->get('message3') }}
                </div>
            </div>

        </div>
        </div>
    @endif


    <script>
        setTimeout(function() {
            $('#success-alert').fadeOut('fast');
        }, 4000);

        setTimeout(function() {
            $('#danger-alert').fadeOut('fast');
        }, 4000);
    </script> --}}

@endif
