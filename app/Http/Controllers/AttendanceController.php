<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Notice;
use App\Models\Holiday;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $title;


    public function getInfo()
    {
        $info['title'] = "Attendance";
        return $info;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $info = $this->getInfo();


        $info['date'] = date('Y-m-d'); // Dynamic date
        $info['attendance'] = Attendance::all(); // Fetch attendance data from the database

        $userAttendance = Attendance::where('user_id', auth()->user()->id);
        $info['employees'] = Employee::get();
        $info['departments'] = Department::get();
        $info['positions'] = Position::get();

        $info['presentDays'] = $userAttendance->where('status', 'present')->count();
        $info['absentDays'] = $userAttendance->where('status', 'absent')->count();
        $info['late'] = Attendance::where('user_id', auth()->user()->id)->where('is_late', true)->count();
        $info['halfDays'] = $userAttendance->whereHas('leave', function ($query) {
            $query->where('duration', 'halfDay');
        })->count();
        $info['holidays'] = Holiday::count();
        $info['attendances'] = Attendance::where('user_id', auth()->user()->id)->whereYear('date', '=', now()->year)
            ->whereMonth('date', '=', now()->month)
            ->get();

        if ($request->ajax()) {
            if ($request->month) {
                $date = Carbon::parse($request->month);
                $attendances = Attendance::where('user_id', auth()->user()->id)->whereYear('date', '=', $date->year)
                    ->whereMonth('date', '=', $date->month)
                    ->get();
                return response()->json($attendances);
            }
        }

        return view("user.attendance.index", $info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        //    dd($user_id);

        //    $absentUser = Attendance::where('user_id', $user_id)->where('status','absent')->whereDate('date', Carbon::today())->exists();
        $todayDate = Carbon::today();

        $absentUsersWithUserData = Attendance::where('user_id', $user_id)
            ->where('status', 'absent')
            ->whereDate('date', $todayDate)
            //            ->with('user') // assuming you have 'user' relation in Attendance model to fetch user data
            ->get();

        //        dd($absentUsersWithUserData);


        if ($absentUsersWithUserData->isEmpty() || !$absentUsersWithUserData) {
            $validatedData = $request->validate([
                'location' => 'sometimes|string|max:255',
                'source' => 'sometimes|string|max:255',
            ]);


            if ($userId = $request->user_id) {
                $date = Carbon::now()->format('Y-m-d');
                $clockTime = Carbon::now();

                $attendance = Attendance::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'date' => $date,
                    ],
                    [
                        $request->clockIn ? 'clock_in_time' : 'clock_out_time' => $clockTime,
                        'status' => $request->clockIn ? 'pending' : 'present',
                        'location' => $validatedData['location'] ?? null,
                        'source' => $validatedData['source'] ?? null,
                    ]
                );

                if ($request->clockIn) {
                    $openingTime = Carbon::createFromFormat('H:i:s', config('erp.open_time'));
                    if ($clockTime->gt($openingTime)) {
                        $late = true;
                    } else {
                        $late = false;
                    }
                    $attendance->update(['is_late' => $late]);

                    return redirect()->back()->with('message', "Sussessfully Clock-In");
                } elseif (!$request->clockIn) {
                    $startDate = Carbon::parse($attendance->clock_in_time);
                    $endDate = Carbon::parse($attendance->clock_out_time);
                    $minutesDifference = $endDate->diffInMinutes($startDate);
                    $attendance->update(['work_hrs' => $minutesDifference]);
                    return redirect()->back()->with('message', "Sussessfully Clock-Out");
                }
            }
        } else {
            return redirect()->back()->with('error', "You are on leave today");
        }
        $date = Carbon::now()->format('Y-m-d');
       
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->getInfo();
        $info['attendances'] = Attendance::findOrFail($id);
       
        return view('user.attendance.show',$info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    // public function months(Request $request)
    // {
    //     $info = $this->getInfo();


    //     $inputMonth = $request->input('month');
    //     $info['inputMonth'] = $inputMonth;

    //     $startDate = now()->year . '-' . $inputMonth . '-01';
    //     $endDate = now()->year . '-' . $inputMonth . '-31';

    //     $info['attendances'] = Attendance::whereBetween('date', [$startDate, $endDate])
    //         ->with('user')
    //         ->get();
    //     // dd($attendances);
    //     return view("user.attendance.index", $info);
    // }


    public function months(Request $request)
    {

        // Get month from the request
        $inputMonth = $request->input('month');
        $employeeId = $request->input('employee');
        $departmentId = $request->input('department');
        $selectedYear = $request->input('year');
        $late = $request->input('late');
        $department_name = Department::where('id', $departmentId)->value('title');
        $positionId = $request->input('position');

        // Calculate start and end dates for the given month
        $startDate = now()->year . '-' . $inputMonth . '-01';
        $endDate = now()->year . '-' . $inputMonth . '-31';

        //calculate start annd end year of the given year


        // dd($endYear);

        // Query attendances for the specified month
        // $attendances = Attendance::whereBetween('date', [$startDate, $endDate])
        //     ->with('user')
        //     ->get();

        $attendances = Attendance::with(['user.employee.position.department'])
            ->when([$startDate, $endDate], function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->when([$selectedYear], function ($query) use ($selectedYear) {
                return $query->whereYear('date', [$selectedYear]);
            })

            ->when($departmentId, function ($query) use ($departmentId) {
                $query->whereHas('user.employee.position.department', function ($query) use ($departmentId) {
                    return $query->where('id', $departmentId);
                });
            })

            ->when($employeeId, function ($query) use ($employeeId) {
                $query->whereHas('user.employee', function ($query) use ($employeeId) {
                    return $query->where('id', $employeeId);
                });
            })


            ->get();

        // dd($attendances);

        // $attendances = Attendance::select('attendances.*')
        //     ->join('employees', 'attendances.user_id', '=', 'employees.user_id')
        //     ->join('positions', 'employees.position_id', '=', 'positions.id')
        //     ->join('departments', 'positions.department_id', '=', 'departments.id')
        //     ->where('departments.title', $department_name)
        //     ->get();



        $data = [
            // 'inputMonth' => $inputMonth,
            'attendances' => $attendances
        ];

        return response()->json($data);
        // return response()->json($data);

        // return response()->json($data, 200);

    }
}
