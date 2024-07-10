<?php

namespace App\Http\Controllers;

use App\Models\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeSheetController extends Controller
{

    protected $title;

    public function getInfo()
    {
        $info['title'] = "Time Sheet";
        return $info;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $task_id = $request->task_id;
        $user_id = Auth::user()->id;
        // dd($user_id);
        $info = $this->getInfo();
        $info['timers'] = Timer::whereNotNull('end_time')
        ->whereNotNull('duration')
        ->get();
        return view('admin.timeSheet.index', $info);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->getInfo();
        $info['timer'] = Timer::findOrFail($id);
        return view("admin.timeSheet.show", $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $info = $this->getInfo();
        return view("admin.timeSheet.edit", $info);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
