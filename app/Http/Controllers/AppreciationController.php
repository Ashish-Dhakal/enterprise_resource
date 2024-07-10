<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Appreciation;
use Illuminate\Http\Request;

class AppreciationController extends Controller
{
    protected $title;

    public function getInfo()
    {
        $info['title'] = "Appreciation";
        return $info;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->getInfo();
        $info['employees'] = Employee::get();
        $info['appreciations'] = Appreciation::paginate(5);
        return view("admin.appreciation.index", $info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->getInfo();
        $info['employees'] = Employee::get();

        return view('admin.appreciation.create', $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $date = $request->given_date;
        $title = $request->title;

        $existingAppreciation = Appreciation::where('given_date', $date)
            ->where('title', $title)
            ->first();

        // dd($existingAppreciation);
        if ($existingAppreciation) {
            return redirect()->route('appreciation.index')->with('error', 'Appreciation already given on that date');
        } else {

            $request->validate([
                'employee_id' => 'required',
                'given_date' => 'required|date|after_or_equal:today',
                'title' => 'required|string|max:255',
            ]);

            $data = $request->all();
            $appreciation = new Appreciation($data);
            $appreciation->save();
            return redirect()->route('appreciation.index')->with('message', 'appreciation added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->getInfo();
        $info['appreciation'] = Appreciation::with('employee')->find($id);

        // $info['employees'] = Employee::get();

        $info['appreciation'] = Appreciation::findOrFail($id);
        return view('admin.appreciation.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->getInfo();
        $info['employees'] = Employee::get();

        $info['appreciation']  = Appreciation::findOrFail($id);
        return view('admin.appreciation.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $appreciation = Appreciation::findOrFail($id);
        $appreciation->update($request->all());
        return redirect()->route('appreciation.index')->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appreciation = Appreciation::find($id);
        $appreciation->delete();
        return back()->with('error', 'Appreciation deleted');
    }
}
