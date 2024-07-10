@extends('adminlte::page')

@section('title', 'Task Detail')

@section('content_header')
    <div class="row">
        {{--    <div class="col"><h1>Task</h1></div> --}}
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
    </div>


@stop

@section('content')
    <div class="container">

        <div class="taskUser-header">
            <div class="two-button">
                
                

               
                                <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn"><i class="far fa-check-circle"></i> Mark as Completed</button>
                                </form>
                {{-- <div class="btn ml-3 btn-primary " id="startStopBtn"> <i class="far fa-clock"></i> Start Timer </div> --}}


                <form action="{{ route('timer.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach ($task->employeeTasks as $employeeTask)
                        <input name="task_id" value="  {{ $task_id }}" hidden>
                    @endforeach
                    <button id="timerButton" class="btn btn-primary">Start Timer</button>
                </form>

                <form action="{{ route('timer.calculation') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach ($task->employeeTasks as $employeeTask)
                        <input name="task_id" value="  {{ $task_id }}" hidden>
                    @endforeach
                    <button id="timerButton" class="btn btn-danger ml-4">Stop Timer</button>
                </form>




                {{-- <div class="btn btn-primary" id="demo"> </div> --}}
                {{-- <div class="btn btn-primary" id="pauseResumeBtn" style="display:none;">Pause/Resume</div>
                <button class="btn btn-primary" id="stopBtn" style="display:none;">Stop</button> --}}


            </div>
            <div class="btn"> <i class="fas fa-file-export"></i> Export</div>
        </div>

        <div class="taskHeader mt-4">Task Details</div>
        {{-- {{ $task->employeeTasks }} --}}


        <div class="taskDetail-box">
            <div class="taskBox mt-4">
                <label class="detail-lable">Task Name:</label> <span class="detailText">{{ $task->title }}</span> <br>

                <label class="detail-lable">Assign By:</label> <span class="detailText">-Adimn</span><br>

                <label class="detail-lable">Project Name:</label> <span
                    class="detailText">{{ $task->project->title }}</span><br>
                <label class="detail-lable">Priority:</label> <span class="detailText">-Most </span><br>

                <label class="detail-lable">Working Days:</label> <span class="detailText">{{ $timePeriodFormatted }}
                    Day</span>


            </div>
            <div class="taskProgress mt-4">
                <label class="detail-lable">Task Status:</label> <span class="detailText">Task in Progress</span> <br>

                <label class="detail-lable">Start Date:</label> <span class="detailText">{{ $task->given_date }}</span><br>

                <label class="detail-lable">End Date:</label> <span class="detailText">{{ $task->given_date }}</span><br>
                <label class="detail-lable">Hours Logged:</label> <span class="detailText" id="totalhrslogged">
                    {{ $hours }}</span><br>

                <label class="detail-lable">Working Days:</label> <span class="detailText">{{ $timePeriodFormatted }}
                    Day</span>
            </div>
        </div>

        <div class="form-row">
            <label for="reason" class="mt-4" style="color: #B6B6B6"> Description of the Task (if needed)</label>
            <textarea class="form-control mb-4" value="{{ old('reason') }}" name="reason" id="reason" cols="30"
                rows="5" placeholder="For e.g : This project is  ----------"></textarea>
        </div>

        <div class="form-row">
            <label for="reason" class="mt-4 pr-4 " style="color: #023E7D"> Comment </label>
            <label for="reason" class="mt-4 pr-4" style="color: #023E7D"> History </label>
            <textarea class="form-control mb-4" value="{{ old('reason') }}" name="reason" id="reason" cols="30"
                rows="5" placeholder="+ Add Comment"></textarea>
        </div>


    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    {{-- <script>
        $(document).ready(function() {
            var startTime; // Variable to hold the start time
            var pauseTime; // Variable to hold the pause time
            var timerInterval; // Variable to hold the interval ID

            // Function to start or stop the timer
            function startStopTimer() {
                if (!startTime) {
                    // If timer is not running, start it
                    startTime = new Date().getTime();
                    $("#demo").html("Timer started.");
                    $("#pauseResumeBtn").text("Pause");
                    $("#pauseResumeBtn").show();
                    $("#stopBtn").show();
                    timerInterval = setInterval(updateTimer, 1000); // Start the interval to update the timer
                } else {
                    // If timer is running, stop it
                    clearInterval(timerInterval); // Clear the interval
                    var now = new Date().getTime();
                    var elapsedTime = now - startTime;
                    var days = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((elapsedTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);
                    $("#demo").html("Time interval: " + days + "d " + hours + "h " + minutes + "m " + seconds +
                        "s ");
                    startTime = null;
                    $("#pauseResumeBtn").hide();
                    $("#stopBtn").hide();
                }
            }

            // Function to pause or resume the timer
            function pauseResumeTimer() {
                if ($("#pauseResumeBtn").text() === "Pause") {
                    clearInterval(timerInterval);
                    pauseTime = new Date().getTime();
                    $("#pauseResumeBtn").text("Resume");
                } else {
                    var pauseDuration = new Date().getTime() - pauseTime;
                    startTime += pauseDuration;
                    timerInterval = setInterval(updateTimer, 1000);
                    $("#pauseResumeBtn").text("Pause");
                }
            }

            // Function to stop the timer
            function stopTimer() {
                clearInterval(timerInterval); // Clear the interval
                var now = new Date().getTime();
                var elapsedTime = now - startTime;
                var days = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));
                var hours = Math.floor((elapsedTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);
                $("#demo").html("Time interval: " + days + "d " + hours + "h " + minutes + "m " + seconds + "s ");

                $("#totalhrslogged").html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");

                startTime = null;
                $("#pauseResumeBtn").hide();
                $("#stopBtn").hide();
            }

            // Function to update the timer
            function updateTimer() {
                var now = new Date().getTime(); // Get the current time
                var elapsedTime = now - startTime; // Calculate the elapsed time

                var days = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));
                var hours = Math.floor((elapsedTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

                $("#demo").html("Timer running: " + days + "d " + hours + "h " + minutes + "m " + seconds + "s ");


            }


            // Add event listener to the button to start or stop the timer
            $("#startStopBtn").on("click", startStopTimer);

            // Add event listener to the pause/resume button
            $("#pauseResumeBtn").on("click", pauseResumeTimer);

            // Add event listener to the stop button
            $("#stopBtn").on("click", stopTimer);


        });
    </script> --}}


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
