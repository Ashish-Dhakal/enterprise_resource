<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Leave;
use App\Models\Notice;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Appreciation;
use App\Models\EmployeeTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected string $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->title = "Dashboard";
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $info['title'] = $this->title;
        $todayDate = Carbon::today();
        $user = Auth::user()->id;
        $employee_id = Employee::where('user_id', $user)->value('id');
        // dd($employee_id);

        $info['task'] = EmployeeTask::where('employee_id' , $employee_id)->count();
        // dd($task);

       
                                    

        $info['attendance'] = Attendance::where('user_id' , $user)
                                ->where('status' , 'present')->count();

        

        $info['passedDueDatesCount'] = Task::join('employee_tasks', 'tasks.id', '=', 'employee_tasks.task_id')
        ->where('employee_tasks.employee_id', $employee_id)
        ->where('tasks.due_date', '<', $todayDate)
        ->count();

        // dd($passedDueDatesCount);


        $info['projectInfo'] = DB::table('employee_tasks')
        ->join('tasks', 'employee_tasks.task_id', '=', 'tasks.id')
        ->join('projects', 'tasks.project_id', '=', 'projects.id')
        ->select('projects.title as project_title', 'tasks.due_date')
        ->where('employee_tasks.employee_id', $employee_id)
        ->get();

   

        // dd($projectInfo);

       





        $info['leaves'] = Leave::where('status', 'approved')
            ->whereDate('date', $todayDate)
            ->get();
        $info['appreciations'] = Appreciation::orderBy('created_at', 'desc')->take(3)->get();
        $info['notices'] = Notice::orderBy('created_at', 'desc')->take(3)->get();


        return view('home', $info);
    }
}
