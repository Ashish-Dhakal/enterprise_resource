<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Project;
use App\Models\Employee;
use Laravel\Prompts\Table;
use Illuminate\Http\Request;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function getInfo()
    {
        $info['title'] = "Task";
        return $info;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->getInfo();
        $info['projects'] = Project::get();

        $info['tasks'] = Task::paginate(5);
        return view("admin.task.index", $info);


        // $user_id = auth()->user()->id;
        // $employee = Employee::where('user_id', $user_id)->first();
        // if ($employee) {
        //     $projects = Project::whereHas('members', function ($query) use ($employee) {
        //         $query->where('employee_id', $employee->id);
        //     })->get();

        //     // Step 3: Get all tasks associated with those projects
        //     $info['tasks'] = Task::whereIn('project_id', $projects->pluck('id'))->get();

        //     return view("admin.task.index", $info);

        //     // Now $tasks contains all tasks associated with the specified user
        // } else {
        //     // Handle case where the user is not associated with any employee
        // }

        // // return view("admin.task.index", $info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->getInfo();
        $info['employees'] = Employee::get();
        $info['projects'] = Project::get();
        $info['projectMembers'] = ProjectMember::get();
        return view('admin.task.create', $info);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'project_id' => 'required',
            'given_date' => 'required|date',
            'started_at' => 'required|date',
            'deadline' => 'required|date',
            // 'completed_at' => 'required|date'
        ]);

        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'project_id' => $validatedData['project_id'],
            'started_at' => $validatedData['started_at'],
            'given_date' => $validatedData['given_date'],
            'due_date' => $validatedData['deadline'],
            // 'completed_at' => $validatedData['completed_at'],
        ]);
        $task->employees()->sync($request->employee_ids);

        return redirect()->route('task.index')->with('message', 'Task added created successfully');
    }

    /**
     * Display the specified resource.
     */
    //    public function show($id)
    //    {
    //        $info = $this->getInfo();
    //        $info['project'] = Task::with('project')->find($id);
    //
    //        // $info['employees'] = Employee::get();
    //
    //        $info['task'] = Task::findOrFail($id);
    //        return view('admin.task.show', $info);
    //    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->getInfo();
        $info['projects'] = Project::get();
        $info['employees'] = Employee::get();
        $info['projectMembers'] = ProjectMember::get();

        $info['task']  = Task::findOrFail($id);
        return view('admin.task.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'project_id' => 'required',
            'given_date' => 'required|date',
            'started_at' => 'required|date',
            'deadline' => 'required|date',
            // 'completed_at' => 'required|date'
        ]);
        $task = Task::findOrFail($id);
        $task->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'project_id' => $validatedData['project_id'],
            'started_at' => $validatedData['started_at'],
            'given_date' => $validatedData['given_date'],
            'deadline' => $validatedData['deadline'],
            // 'completed_at' => $validatedData['completed_at'],
        ]);

        $task->employees()->sync($request->employee_ids);
        // $task->update($request->all());
        return redirect()->route('task.index')->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->employeeTasks()->delete();
        $task->delete();
        return redirect()->route('task.index')->with('error', 'Task deleted');
    }


    public function getTaskInformation($id)
    {
        // dd($id);
        $info = $this->getInfo();
        $info['task_id'] = $id;

        $info['task'] = Task::findOrFail($id);
        $task = Task::findOrFail($id);
        $givenDate = Carbon::parse($task->given_date);
        $currentDate = Carbon::now();

        $info['timePeriodFormatted'] = $currentDate->diffInDays($givenDate);

        $info['hours'] = $currentDate->diffForHumans($givenDate);

        return view("admin.task.taskUser", $info);
    }
}
