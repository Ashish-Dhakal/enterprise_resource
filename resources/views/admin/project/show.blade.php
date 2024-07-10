@extends('adminlte::page')

@section('title', 'View Project')

@section('content_header')

@stop
<style>
    .text {
        color: #023E7D;
        align-items: center;
    }

    .timesheet-export {
        border: 1px solid #B6B6B6;
        color: #C2699E;
    }
</style>

@section('content')
    <div class="container">

        <button class=" btn timesheet-export mt-4 border">Export<i class="fas fa-file-export" style="color: #C2699E;"></i>
        </button>

        <div class="nav-tab mt-4">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Members</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Task</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">

                    <div class="row">

                        <div class="col-5">
                            <div class="task-info">
                                <label for="projectTitle">Project Title:</label><span>{{ $project->title }}</span> <br>
                                <label for="priority">Priority : </label><span>Most</span> <br>
                                <label for="stateDate">Start Date : </label><span>{{ $project->started_at }}</span> <br>
                                <label for="endDate">End Date : </label><span>{{ $project->deadline_at }}</span> <br>
                                <label for="workingDays">Working Days : </label><span>5 Days</span> <br>
                            </div>
                        </div>

                        <div class="col-7">
                            <input type="hidden" value='@json($tasks)' id="taskInfo">
                            <div class="task-chart ">
                                <canvas class="chart-detail" id="myChart" style="width:100%;max-width:600px"></canvas>
                            </div>

                            <div class="hourloggs">
                                <label for="hourLogged" style="color: #979797;"> Hour Logged: <span
                                        style="color: #023E7D;">   {{$totalDuration?? '-'}}</span></label>
                            </div>

                        </div>
                    </div>

                </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">

                <table class="table table-bordered" id="employee-table">
                    <thead>
                        <tr>
                            <th>SN.</th>
                            <th>Member Role</th>
                            <th>Assigned Date</th>
                        </tr>
                    </thead>



                    <tbody>
                        @foreach ($project->employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="d-flex">
                                    <div class="user-image pr-3">
                                        <img height="45px" width="45px" src="/uploads/employee/{{ $employee->image }}">
                                    </div> {{ $employee->first_name }} {{ $employee->last_name }} <br>
                                    {{ $employee->position->title }}
                                </td>
                                {{-- <td>{{ $user->position_id }}</td> --}}
                                <td>{{ $project->started_at }}</td>
                        @endforeach

                    </tbody>

                </table>



            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                tabindex="0">


                <table class="table table-bordered" id="employee-table">
                    <thead>
                        <tr>
                            <th>Task Id</th>
                            <th>Task Name</th>
                            <th>Task Description</th>
                            <th>Assigned Date</th>
                            <th>Due Date</th>
                            <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($task as $tasks)
                            <tr>
                                <td>{{ $tasks->id }}</td>
                                <td>{{ $tasks->title }}</td>
                                <td>{{ $tasks->description }}</td>
                                <td>{{ $tasks->given_date }}</td>
                                <td>{{ $tasks->due_date }}</td>
                                <td>{{ $tasks->task_status ?? '-' }}</td>
                                <td><i class="fas fa-eye"></i></td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>



            </div>
             </div>
        </div>




    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script>
        let taskArray = JSON.parse($('#taskInfo').val());

        // let keys = [];
        // let values = [];

        // Store keys and values
        let xValues = [];
        let yValues = [];

        // Extract keys and values
        for (const key in taskArray) {
            if (Object.hasOwnProperty.call(taskArray, key)) {
                xValues.push(key);
                yValues.push(taskArray[key]);
            }
        }

        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9"
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                }
            }
        });
    </script>
@stop
