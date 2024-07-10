<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{

    protected $title;

    public function getInfo()
    {
        $info['title'] = "Leave";
        return $info;
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $info = $this->getInfo();
        $user = Auth::user()->role;
        // dd($user);

        //  = Leave::where('user_id', $user);

        // $info['leaves'] = Leave::paginate(5);

        if ($user == 'Admin') {
            $info['leaves'] = Leave::all();
            return view("admin.leave.index", $info);
        } else {
            $info['leaves'] = Leave::where('user_id', auth()->id())->get();
            return view("admin.leave.index", $info);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $info = $this->getInfo();
        $info['user'] = Auth::user();



        // $employee = Employee::get();
        return view('admin.leave.create', $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'reason' => 'required|string|max:255',
            'type' => 'required|string',
            'duration' => 'required|string|in:halfDay,fullDay',
            'date' => 'required',
            //            'status'=>'required',
        ]);


        $data = $request->all();
        $leave = new Leave($data);
        $leave->save();


        //        $leave->attendance()->save($leave);




        return redirect()->route('leave.index')->with('message', 'Leave added successfully');
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->getInfo();
        $info['leave'] = Leave::findOrFail($id);
        return view('admin.leave.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->getInfo();
        $info['leave'] = Leave::findOrFail($id);
        $info['user'] = Auth::user();
        return view('admin.leave.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {


        // $leave = Leave::findOrFail($id);
        // // dd($leave->user);
        // $leave->update($request->all());

        $validatedData = $request->validate([
            'user_id' => 'required',
            'reason' => 'required|string|max:255',
            'type' => 'required|string',
            'duration' => 'required|string|in:halfDay,fullDay',
            'date' => 'required',
            'status' => 'required',
        ]);
        $leave = Leave::findOrFail($id);
        // // dd($leave->user);
        $leave->update($validatedData);



        // dd($id);
        if ($leave->status === 'approved') {
$userr = $id;
            $user = User::where('user_id', $userr);

            //            $validatedData = $request->validate([
            //                'date' => 'required',]);
            //            $data = $request->all();

            //            dd($leave->date);
            if ($user) {
                $user_id = $userr;
                $attendance = Attendance::create([
                    'leave_id' => $id,
                    'user_id' => $user_id,
                    'status' => "absent",
                    'date' => $leave->date,
                ]);
            }
        }
        return redirect()->route('leave.index')->with('message', 'Record updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leave = Leave::find($id);
        $leave->delete();
        return back()->with('error', 'Leave deleted');
    }
}
