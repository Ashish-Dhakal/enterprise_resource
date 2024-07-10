@extends('adminlte::page')

@section('title', 'My Attendance')

@section('content')
    @can('user-attendance')

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif
        <div class="container ">

            <div class="attendance-box">

                <div class="assign-leave" style="font-size:20px; padding:10px 0 10px 0">
                    <div class="back-icon ">
                        <a href=""><i class="fas fa-file-upload"></i> <span class="pr-10"> Export</span></a>
                    </div>
                    <div class="setting-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                </div>

                <div class="att-card">
                    <div class="att-box">
                        <div class="att-header">
                            <div class="box-title">Working Days</div>
                            <div class="box-icon"><i class="far fa-calendar-alt"></i></div>
                        </div>
                        <div class="att-dyn-data"><span class="att-data">30</span></div>
                        <div class="att-svg">
                            {{-- 334 77 --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="334" height="77
                        "
                                viewBox="0 0 382 87" fill="none">
                                <path
                                    d="M163.931 21.6499C126.49 41.5613 29.177 40.7103 0 21.6499V79C0 83.4183 3.58172 87 7.99999 87H374C378.418 87 382 83.4183 382 79V21.6499C314.404 -17.5602 208.456 5.31238 163.931 21.6499Z"
                                    fill="#E1F0FE" />
                            </svg>
                        </div>
                    </div>

                    <div class="att-box">
                        <div class="att-header">
                            <div class="box-title">Days Present</div>
                            <div class="box-icon"><i class="far fa-calendar-alt"></i></div>
                        </div>
                        <div class="att-dyn-data"><span class="att-data">{{ $presentDays }}</span></div>
                        <div class="att-svg">
                            {{-- 334 77 --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="334" height="77
                        "
                                viewBox="0 0 382 87" fill="none">
                                <path
                                    d="M163.931 21.6499C126.49 41.5613 29.177 40.7103 0 21.6499V79C0 83.4183 3.58172 87 7.99999 87H374C378.418 87 382 83.4183 382 79V21.6499C314.404 -17.5602 208.456 5.31238 163.931 21.6499Z"
                                    fill="#E1F0FE" />
                            </svg>
                        </div>
                    </div>

                    <div class="att-box">
                        <div class="att-header">
                            <div class="box-title">Late</div>
                            <div class="box-icon"><i class="far fa-calendar-alt"></i></div>
                        </div>
                        <div class="att-dyn-data"><span class="att-data">{{ $late }}</span></div>
                        <div class="att-svg">
                            {{-- 334 77 --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="334" height="77
                        "
                                viewBox="0 0 382 87" fill="none">
                                <path
                                    d="M163.931 21.6499C126.49 41.5613 29.177 40.7103 0 21.6499V79C0 83.4183 3.58172 87 7.99999 87H374C378.418 87 382 83.4183 382 79V21.6499C314.404 -17.5602 208.456 5.31238 163.931 21.6499Z"
                                    fill="#E1F0FE" />
                            </svg>
                        </div>
                    </div>

                    <div class="att-box">
                        <div class="att-header">
                            <div class="box-title">Half Days</div>
                            <div class="box-icon"><i class="far fa-calendar-alt"></i></div>
                        </div>
                        <div class="att-dyn-data"><span class="att-data">{{ $halfDays }}</span></div>
                        <div class="att-svg">
                            {{-- 334 77 --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="334" height="77
                        "
                                viewBox="0 0 382 87" fill="none">
                                <path
                                    d="M163.931 21.6499C126.49 41.5613 29.177 40.7103 0 21.6499V79C0 83.4183 3.58172 87 7.99999 87H374C378.418 87 382 83.4183 382 79V21.6499C314.404 -17.5602 208.456 5.31238 163.931 21.6499Z"
                                    fill="#E1F0FE" />
                            </svg>
                        </div>
                    </div>

                    <div class="att-box">
                        <div class="att-header">
                            <div class="box-title">Absent Days</div>
                            <div class="box-icon"><i class="far fa-calendar-alt"></i></div>
                        </div>
                        <div class="att-dyn-data"><span class="att-data">{{ $absentDays }}</span></div>
                        <div class="att-svg">
                            {{-- 334 77 --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="334" height="77
                        "
                                viewBox="0 0 382 87" fill="none">
                                <path
                                    d="M163.931 21.6499C126.49 41.5613 29.177 40.7103 0 21.6499V79C0 83.4183 3.58172 87 7.99999 87H374C378.418 87 382 83.4183 382 79V21.6499C314.404 -17.5602 208.456 5.31238 163.931 21.6499Z"
                                    fill="#E1F0FE" />
                            </svg>
                        </div>
                    </div>

                    <div class="att-box">
                        <div class="att-header">
                            <div class="box-title">Holidays</div>
                            <div class="box-icon"><i class="far fa-calendar-alt"></i></div>
                        </div>
                        <div class="att-dyn-data"><span class="att-data">{{ $holidays }}</span></div>
                        <div class="att-svg">
                            {{-- 334 77 --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="334" height="77
                        "
                                viewBox="0 0 382 87" fill="none">
                                <path
                                    d="M163.931 21.6499C126.49 41.5613 29.177 40.7103 0 21.6499V79C0 83.4183 3.58172 87 7.99999 87H374C378.418 87 382 83.4183 382 79V21.6499C314.404 -17.5602 208.456 5.31238 163.931 21.6499Z"
                                    fill="#E1F0FE" />
                            </svg>
                        </div>
                    </div>
                </div>


                <input type="month" name="date" class="form-control mt-2" id="date"
                    value="{{ \Carbon\Carbon::now()->format('Y-m') }}">


                <div class="card my-2">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Clock In</th>
                                        <th scope="col">Clock Out</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances ?? [] as $attendance)
                                        <tr>
                                            <th>{{ $attendance->date }}</th>
                                            <td>{{ ucfirst($attendance->status) }}</td>
                                             <td>{{ $attendance->clock_in ?: '---' }}</td>
                                            <td>{{ $attendance->clock_out ?: '---' }}</td>
                                            <td>{{ $attendance->work_hrs ?: '---' }}</td>
                                            {{-- <td><i class="fas fa-eye"></i></td> --}}
                                            <td> <a href="{{ route('attendance.show', $attendance->id) }}" class="btn"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    @endcan


    @can('admin-attendance')

        <style>
            select {
                word-wrap: normal;
                border-radius: 10px;
                padding: 2px;

                option {
                    border-radius: 10px;

                }
            }
        </style>
        <div class="container">
            <div class="attendance-catinfo d-flex pt-4 ">
                <div class="employee">
                    <label for="employee">Employee</label>
                    <select id="employee" name="employee">
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="department pl-3">
                    <label for="department">Department</label>
                    <select id="department" name="department">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->title }}
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="montn pl-3">
                    <label for="month">Month</label>
                    <select name="month" id="month">
                        <option value="">Select Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>

                    </select>
                </div>

                {{-- <div class="year pl-3">
                    <label for="year">Year</label>
                    <select id="year" name="year" required>
                        <option value="">All</option>
                        <option value="">All</option>
                        <option value="">All</option>
                    </select>
                </div> --}}

                <div class="year pl-3">
                    <label for="year">Year</label>
                    <select id="year" name="year">
                        <option value="">Select a year</option>
                    </select>
                </div>


                <div class="late pl-3">
                    <label for="late">Late</label>
                    <select id="late" name="late" required>
                        <option value="All  ">All</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

            </div>

            <div class="attendance-action d-flex justify-content-between mt-3   ">
                <div class="combo-btn1">
                    <a href="" class="btn"> + Mark Attendance</a>
                    <a href=""class="btn"><i class="fas fa-file-import"></i> Import</a>
                    <a href=""class="btn"><i class="fas fa-file-download"></i></i> Import</a>
                </div>
                <div class="combo-btn2 ">
                    <a href=""><i class="fas fa-list"></i></a>
                    <a href=""><i class="fas fa-user"></i></a>
                    <a href=""><i class="far fa-clock"></i></a>
                    <a href=""><i class="fas fa-map"></i></a>
                </div>

            </div>


            {{-- 
              
                <div id="attendanceTable">
                     <table class="mt-3 border" style="width: 100%">
                        <thead>
                            <th>Employee</th>
                            <th>User</th>
                        </thead>
                        <tbody id="attendanceBody">

                        </tbody> 

                </div>
             --}}


            <div class="attendance-info-table mt-3">

                <table class="mt-3" border="1" style="width: 100%">
                    <tr>
                        <th>Employee</th>
                        @for ($day = 1; $day <= 31; $day++)
                            <th style="padding:5px;">{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}</th>
                        @endfor
                    </tr>
                    <tbody id="attendanceBody">

                    </tbody>
                </table>

            </div>




        </div>
    @endcan



    <!-- Bootstrap JS and dependencies -->


@stop

@section('css')
    <link rel="stylesheet" href="css/user_attendance.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- <script>
        console.log('Hi!');
    </script> -->

    {{-- <script>
        $(document).on('change', '#date', function() {

            let value = $(this).val();
            $.ajax({
                url: '{{ route('attendance.index') }}',
                method: 'GET',
                data: {
                    month: value
                },
                success: function(response) {
                    console.log(response);
                    $('.table tbody').empty(); // Clear existing table rows
                    $.each(response, function(index, attendance) {
                        let newRow = `<tr>
                                    <th>${attendance.date}</th>
                                    <td>${attendance.status}</td>
                                    <td>${attendance.clock_in_time || '---'}</td>
                                    <td>${attendance.clock_out_time || '---'}</td>
                                    <td>${attendance.work_hrs || '---'}</td>
                                    <td><i class="fas fa-eye"></i></td>
                                  </tr>`;
                        $('.table tbody').append(newRow); // Append new row to the table
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(status, error);
                }
            });
        })
    </script> --}}



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- 
<script>
    $(document).ready(function () {
        $('#filterButton').on('click', function (e) {
            e.preventDefault();
            var formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ route('attendance.months') }}",
                type: 'POST',
                data: formData,
                success: function (response) {
                    // Replace the entire table with the filtered data
                    $('.attendance-table').html(response.view);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> --}}


    {{-- <script>
        $(document).ready(function() {
            // AJAX form submission
            $(document).on('change', '#month', function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    type: 'POST',
                    url: "{{ route('attendance.months') }}",
                    data: {
                        '_token': "{{ csrf_token() }}", // Include CSRF token as part of data

                        'month': $('#month').val()
                    },
                    success: function(response) {
                        // Handle success response
                        console.log('Data received successfully:');
                        console.log(response);

                        // Generate table HTML
                         var tableHtml =
                             '<table class="mt-3" border="1" style="width: 100%"><tr><th>Employee</th>';

                         // Add table headers for days
                         for (var day = 1; day <= 31; day++) {
                             tableHtml += '<th style="padding:5px;">' + ('0' + day).slice(-2) +
                                 '</th>';
                         }

                        tableHtml = '';

                        // Add table rows for each attendance record
                        response.attendances.forEach(function(attendance) {
                            console.log('Attendance:', attendance);

                            tableHtml += '<tr><td>' + attendance.user.date + '</td>';
                            tableHtml += '<tr><td>' + attendance.status + '</td>';;
                           

                            // // Create a map to store attendance data by date
                            // var attendanceDataByDate = {};

                            // // Group attendance data by date
                            // attendance.attendances.forEach(function(att) {
                            //     var date = new Date(att.date);
                            //     var dayOfMonth = date.getDate();
                            //     attendanceDataByDate[dayOfMonth] = att;
                            // });

                            // // Add table cells for each day
                            // for (var day = 1; day <= 31; day++) {
                            //     var attendanceData = attendanceDataByDate[day];
                            //     var status = attendanceData ? (attendanceData.status ===
                            //         'present' ? 'P' : 'A') : '-';
                            //     tableHtml += '<td style="padding:5px;">' + status +
                            //         '</td>';
                            // }

                            tableHtml += '</tr>';
                        });

                        // tableHtml += '</table>';

                        // Append table to the document
                        $('#attendanceBody').html(tableHtml);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Error receiving data:', error);
                    }
                });
            });
        });
    </script> --}}

    {{-- script for date  --}}

    <script>
        // Get the select element
        var selectYear = document.getElementById("year");

        // Get the current year
        var currentYear = new Date().getFullYear();

        // Loop to generate options for the past five years
        for (var i = 0; i < 5; i++) {
            var option = document.createElement("option");
            option.value = currentYear - i;
            option.text = currentYear - i;
            selectYear.appendChild(option);
        }
    </script>





    <script>
        $(document).ready(function() {
            // AJAX form submission
            $(document).on('change', '#department ,#month ,#employee ,#position ,#year , #late ', function(event) {
                event.preventDefault(); // Prevent default form submission
                $.ajax({
                    type: 'POST',
                    url: "{{ route('attendance.months') }}",
                    data: {
                        '_token': "{{ csrf_token() }}", // Include CSRF token as part of data
                        'month': $('#month').val(),
                        'department': $('#department').val(),
                        'position': $('#position').val(),
                        'employee': $('#employee').val(),
                        'year': $('#year').val(),
                        'late': $('#late').val(),

                    },

                    success: function(response) {
                        // Handle success response
                        console.log('Data received successfully:');
                        console.log(response);

                        var late = $('#late').val();

                        // Generate table rows for each attendance record
                        var tableRows = '';

                        // Iterate over the attendances array
                        response.attendances.forEach(function(attendance) {
                            console.log('Attendance:', attendance);
                            var rowData = '<tr>';
                            rowData += '<td>' + attendance.user.name +
                                '</td>'; // Displaying user name
                            // Add table cells for each day
                            for (var day = 1; day <= 31; day++) {
                                var status = '-';

                                // Check if the current attendance record matches the day
                                if (attendance.date && (new Date(attendance.date))
                                    .getDate() === day) {

                                    if (late == 1) {
                                        status = (attendance.is_late == 1 && attendance
                                            .status === 'present') ? 'L' : '-'

                                    } else if (late == 0) {
                                        status = (attendance.is_late == 0 || attendance
                                            .status === 'present') ? 'P' : '-';
                                    } else {
                                        status = attendance.is_late === 1 ? 'L' :
                                            attendance.status === 'present' ? 'P' :
                                            'A';
                                    }



                                }
                                rowData += '<td style="padding:5px;">' + status +
                                    '</td>';
                            }
                            rowData += '</tr>';
                            tableRows += rowData;
                        });

                        // Append table rows to the tbody
                        $('#attendanceBody').html(tableRows);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Error receiving data:', error);
                    }
                });
            });
        });
    </script>













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
