<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leave;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Notifications\HolidayNotification;

class HolidayController extends Controller
{

    protected $title;

    public function getInfo()
    {
        $info['title'] = "Holiday";
        return $info;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->getInfo();

        $info['holidays'] = Holiday::paginate(5);
        return view("admin.holiday.index", $info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->getInfo();

        return view('admin.holiday.create',$info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'day' => 'required'
        ]);

        $data = $request->all();
        $holiday = new Holiday($data);
        $holiday->save();

        $users = User::all(); // Assuming User is your user model
        foreach ($users as $user) {
            $user->notify(new HolidayNotification($holiday));
        }


        return redirect()->route('holiday.index')->with('message', 'Holiday added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->getInfo();

        $info['holiday'] = Holiday::findOrFail($id);
        return view('admin.holiday.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->getInfo();
        $info['holiday']  = Holiday::findOrFail($id);
        return view('admin.holiday.edit',$info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->update($request->all());
        return redirect()->route('holiday.index')->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $holiday = Holiday::find($id);
        $holiday->delete();
        return back()->with('error', 'Holiday deleted');
    }
}
