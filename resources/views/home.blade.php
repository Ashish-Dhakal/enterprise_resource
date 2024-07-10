@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}

    <div class="dashboard">

        <div class="group-box d-grid">
            <div class="box box-one">
                <div class="box-title">Total Task <br> {{ $task }}</div>
                <div class="box-icon"> <i class="fas fa-tasks"></i> </div>
            </div>

            <div class="box box-two">
                <div class="box-title">New Task <br> {{ $task }} </div>
                <div class="box-icon"> <i class="fas fa-tasks"></i> </div>
            </div>

            <div class="box box-three">
                <div class="box-title">Due Task <br> {{ $passedDueDatesCount }}</div>
                <div class="box-icon"> <i class="fas fa-tasks"></i> </div>
            </div>

            <div class="box box-four">
                <div class="box-title">Attendance <br> {{ $attendance }}</div>
                <div class="box-icon">
                    <i class="fas fa-user-clock"></i>
                </div>
            </div>

        </div>

        <div class="combo-box">

            <div class="leave-deadline-box">
                <div class="deadline-box">


                    {{-- @foreach ($projectInfo as $info)
                 <div class="deadlinebox">
                        <div class="box-header">
                            <div class="title">Upcomming Title</div>
                            <div class="title-icon">
                                <i class="far fa-hourglass"></i>
                            </div>
                        </div>
                        <p>{{$info->project_title}}</p>

                        <div class="deadline-time float-md-right ">{{$info->due_date}}</div>
                    </div>
            @endforeach --}}

                    @if ($projectInfo->isEmpty())
                        <div class="deadlinebox">
                            <div class="box-header">
                                <div class="title">Upcoming Title</div>
                                <div class="title-icon">
                                    <i class="far fa-hourglass"></i>
                                </div>
                            </div>
                            <p>No data</p>
                            <div class="deadline-time float-md-right"> </div>
                        </div>

                         <div class="deadlinebox">
                            <div class="box-header">
                                <div class="title">Upcoming Title</div>
                                <div class="title-icon">
                                    <i class="far fa-hourglass"></i>
                                </div>
                            </div>
                            <p>No data</p>
                            <div class="deadline-time float-md-right"> </div>
                        </div>
                    @else
                        @foreach ($projectInfo as $info)
                            <div class="deadlinebox">
                                <div class="box-header">
                                    <div class="title">Upcoming Title</div>
                                    <div class="title-icon">
                                        <i class="far fa-hourglass"></i>
                                    </div>
                                </div>
                                <p>{{ $info->project_title }}</p>
                                <div class="deadline-time float-md-right">{{ $info->due_date }}</div>
                            </div>
                        @endforeach
                    @endif




                    {{-- <div class="deadlinebox">
                        <div class="box-header">
                            <div class="title">Upcomming Title</div>
                            <div class="title-icon">
                                <i class="far fa-hourglass"></i>
                            </div>
                        </div>
                        <p>Lorem, ipsum. ipsum.Lorem</p>

                        <div class="deadline-time float-md-right">Today,12:10A.M</div>
                    </div> --}}
                </div>

                <div class="leave-box">
                    <div class="box-header">
                        <div class="title">On Leave Today</div>
                        <div class="title-icon">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                    </div>

                    @if ($leaves->isEmpty())
                    <div class="leave-info">
                            <div class="user-info">
                                <div class="image">
                                    
                                </div>
                                <div class="user-name">
                                    No data
                                </div>
                            </div>
                            <div class="leave-duration">
                             
                            </div>
                            <div class="leave-type">
                                
                            </div>


                        </div>

                       @else
                        @foreach ($leaves as $leave)
                        <div class="leave-info">
                            <div class="user-info">
                                <div class="image">
                                    <img src="/uploads/employee/{{ $leave->user->employee?->image }}" alt="">
                                </div>
                                <div class="user-name">
                                    {{ $leave->user->name }} <br>
                                    {{ $leave->user->employee?->position->title }}
                                </div>
                            </div>
                            <div class="leave-duration">
                                {{ $leave->duration }}
                            </div>
                            <div class="leave-type">
                                {{ $leave->type }}
                            </div>


                        </div>
                    @endforeach
                        
                    @endif
                   
                </div>

            </div>


            <div class="calender-box">
                <div class="box-header">
                    <div class="title">Calender</div>
                    <div class="title-icon">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
                <div class="calender">
                    <div class="calendar">
                        <header>
                            <h3></h3>
                            <nav>
                                <button id="prev"></button>
                                <button id="next"></button>
                            </nav>
                        </header>
                        <section class="calender-section">
                            <ul class="days">
                                <li>Sun</li>
                                <li>Mon</li>
                                <li>Tue</li>
                                <li>Wed</li>
                                <li>Thu</li>
                                <li>Fri</li>
                                <li style=" color: red">Sat</li>
                            </ul>
                            <ul class="dates"></ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>


        <div class="appreciation-notice-box">
            <div class="appreciation-box">
                <div class="box-header">
                    <div class="title">Appreciation</div>
                    <div class="title-icon">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>

                @if ($appreciations->isEmpty())

                <div class="leave-info">
                        <div class="user-info">
                            <div class="image">
                                
                            </div>
                            <div class="user-name">
                                No data
                            </div>
                        </div>
                        <div class="leave-duration">
                            <i class="fas fa-medal" style="font-size: 25px"></i>
                        </div>
                        <div class="leave-type">
                           
                        </div>


                    </div>

                @else
                 @foreach ($appreciations as $appreciation)
                    <div class="leave-info">
                        <div class="user-info">
                            <div class="image">
                                <img src="uploads/employee/{{ $appreciation->employee->image }}" alt="">
                            </div>
                            <div class="user-name">
                                {{ $appreciation->employee->first_name }}
                                {{ $appreciation->employee->last_name }} <br>
                                {{-- {{ $leave->user->employee->position->title }} --}}
                            </div>
                        </div>
                        <div class="leave-duration">
                            <i class="fas fa-medal" style="font-size: 25px"></i>
                        </div>
                        <div class="leave-type">
                            {{ $appreciation->title }} <br>
                            {{ $appreciation->given_date }}
                        </div>


                    </div>
                @endforeach
                    
                @endif


               
            </div>
            <div class="notice-box">
                <div class="box-header">
                    <div class="title">Notice</div>
                    <div class="title-icon">
                        <i class="fas fa-volume-up"></i>
                    </div>
                </div>


                <div class="notice-info">

                    @if ($notices->isEmpty())

                    <div class="notice-info-title -ml-3">
                            <div class="header"></div>
                            <div class="date">
                                <i class="fas fa-calendar-alt pr-3"></i>
                            </div>
                        </div>
                        <div class="notice-text">
                           No data
                        </div>
                        <div class="notice-button btn" style="padding-left: 300px">
                            >
                        </div>

                        
                    @else

                     @foreach ($notices as $notice)
                        <div class="notice-info-title -ml-3">
                            <div class="header">{{ $notice->title }}</div>
                            <div class="date">
                                <i class="fas fa-calendar-alt pr-3"></i>{{ $notice->date }}
                            </div>
                        </div>
                        <div class="notice-text">
                            {!! Str::limit($notice->description, 50, '<span class="text-danger"> more...</span>') !!}
                        </div>
                        <div class="notice-button btn" style="padding-left: 300px">
                            <a href="{{ route('notice.show', $notice->id) }}"> <span class="notice-view-btn">View
                                    Details</span></a>
                        </div>
                        <hr>
                    @endforeach


                    @endif


                   
                </div>

            </div>
        </div>



    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const header = $(".calendar h3");
            const dates = $(".dates");
            const navs = $("#prev, #next");

            const months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];

            let date = new Date();
            let month = date.getMonth();
            let year = date.getFullYear();

            function renderCalendar() {
                const start = new Date(year, month, 1).getDay();
                const endDate = new Date(year, month + 1, 0).getDate();
                const end = new Date(year, month, endDate).getDay();
                const endDatePrev = new Date(year, month, 0).getDate();

                let datesHtml = "";

                for (let i = start; i > 0; i--) {
                    datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
                }

                for (let i = 1; i <= endDate; i++) {
                    let className =
                        i === date.getDate() &&
                        month === new Date().getMonth() &&
                        year === new Date().getFullYear() ?
                        ' class="today"' :
                        "";
                    className += new Date(year, month, i).getDay() === 6 ? ' style="color: red;"' :
                        ""; // Adding red color for Saturday
                    datesHtml += `<li${className}>${i}</li>`;
                }

                for (let i = end; i < 6; i++) {
                    datesHtml += `<li class="inactive">${i - end + 1}</li>`;
                }

                dates.html(datesHtml);
                header.text(`${months[month]} ${year}`);
            }

            navs.on("click", function(e) {
                const btnId = e.target.id;

                if (btnId === "prev" && month === 0) {
                    year--;
                    month = 11;
                } else if (btnId === "next" && month === 11) {
                    year++;
                    month = 0;
                } else {
                    month = btnId === "next" ? month + 1 : month - 1;
                }

                date = new Date(year, month, new Date().getDate());
                year = date.getFullYear();
                month = date.getMonth();

                renderCalendar();
            });

            renderCalendar();
        });
    </script>



@stop
