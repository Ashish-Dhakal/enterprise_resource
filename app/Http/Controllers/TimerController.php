<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Timer;
use App\Models\EmployeeTask;
use Illuminate\Http\Request;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $task_id = $request->task_id;
    //     $user =  Auth::user()->id;


    //     $employeeTasks = EmployeeTask::where('task_id', $task_id)
    //         ->where('employee_id', $user)
    //         ->first();

    //     if ($employeeTasks) {
    //         $startTimer = Carbon::now();
    //         $timer = Timer::create([
    //             'user_id' => $user,
    //             'task_id' => $task_id,
    //             'start_time' => $startTimer
    //         ]);
    //         $timer->save();
    //         return redirect()->route('task.index')->with('message', 'The timer is started');
    //     } else {
    //         return redirect()->route('task.index')->with('error', 'This task is not assigned to you.');
    //     }

    // }

    public function store(Request $request)
    {
        // $task_id = $request->task_id;
        // $user_id = Auth::user()->employee->id;

        // $taskk = (int)$task_id;
        // // dd('user', $user_id, 'task', $taskk);

        // $assignment = EmployeeTask::where('employee_id', $user_id)
        //     ->where('task_id', $taskk)
        //     ->first();


        // $endtime = Timer::where('task_id ', $taskk)
        //     ->whereIn('end_time', null);


        // if ($assignment) {
        //     // If the user is assigned to the task, start the timer
        //     $startTimer = Carbon::now();
        //     $timer = new Timer();
        //     $timer->user_id = $user_id;
        //     $timer->task_id = $task_id;
        //     $timer->start_time = $startTimer;
        //     $timer->save();

        //     return redirect()->route('task.index')->with('message', 'The timer is started');
        // } else {
        //     // If the user is not assigned to the task, return with an error message
        //     return redirect()->route('task.index')->with('error', 'You are not assigned to this task.');
        // }


        $task_id = $request->task_id;
        $admin = Auth::user()->id;

        if($admin == 1)
        {
            return redirect()->route('task.index')->with('error', 'You are admin');

        }
        else{
            $user_id = Auth::user()->employee->id;
            $role = Auth::user()->role;

            $taskk = (int) $task_id;

            // Check if there is an existing timer record with a null end time
            $existingTimer = Timer::where('task_id', $taskk)
                ->where('user_id', $user_id)
                ->whereNull('end_time')
                ->first();

            if ($existingTimer) {
                // If an existing timer record with a null end time is found, update the start time
                // $existingTimer->start_time = Carbon::now();
                $existingTimer->save();

                return redirect()->route('task.index')->with('message', 'Timer is already started.');
            } else {
                // Check if the user is assigned to the task
                $assignment = EmployeeTask::where('employee_id', $user_id)
                    ->where('task_id', $taskk)
                    ->exists();

                if ($assignment) {
                    // If the user is assigned to the task and no existing timer record is found, create a new timer record
                    $user_id = Auth::user()->id;
                    // dd($user_id);
                    $startTimer = Carbon::now();
                    $timer = new Timer();
                    $timer->user_id = $user_id;
                    $timer->task_id = $task_id;
                    $timer->start_time = $startTimer;
                    $timer->save();

                    return redirect()->route('task.index')->with('message', 'Timer started.');
                } else {
                    // If the user is not assigned to the task, return with an error message
                    return redirect()->route('task.index')->with('error', 'You are not assigned to this task.');
                }
            }
            
        }
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Timer $timer)
    {
        //
    }
    public function calculation(Request $request, Timer $timer)
    {
        $task_id = $request->task_id;
        $user_id = Auth::user()->id;

        $timerData = Timer::where('user_id', $user_id)
            ->where('task_id', $task_id)
            ->whereNull('end_time') // Consider only timers with no end time
            ->first();

        if ($timerData) {

            $endTime = Carbon::now();
            $startTime = $timerData->start_time;
            $stime = Carbon::parse($startTime);
            $timeDiff = $stime->diff($endTime);

            // Format the time difference
            $formattedTimeDiff = '';
            if (
                $timeDiff->d > 0
            ) {
                $formattedTimeDiff .= $timeDiff->d . 'd ';
            }
            $formattedTimeDiff .= $timeDiff->h . 'h ';
            $formattedTimeDiff .= $timeDiff->i . 'm ';
            $formattedTimeDiff .= $timeDiff->s . 's';

            // Update the existing timer record with the calculated end time and duration
            $timerData->end_time = $endTime;
            $timerData->duration = $formattedTimeDiff;
            $timerData->save();

            // Redirect to the desired route with a success message
            return redirect()->route('task.index')->with('message', 'Your timer stopped. Time elapsed: (' . $formattedTimeDiff . ')');
        } else {
            return redirect()->route('task.index')->with('error', 'first start timer');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timer $timer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timer $timer)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timer $timer)
    {
        //
    }
}
