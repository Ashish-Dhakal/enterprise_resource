<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Leave;
use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{

    protected $title;

    public function getInfo()
    {
        $info['title'] = "Position";
        return $info;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $info = $this->getInfo();
        $info['positions'] = Position::paginate(5);
        return view('admin.position.index', $info );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->getInfo();

        // $info['positions'] = Position::with('department')->get();
        $info['departments'] = Department::get();
        return view('admin.position.create', $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $data = $request->all();
        $position = new Position($data);
        $position->save();
        return redirect()->route('position.index')->with('message', 'Position added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->getInfo();

        $positions = Position::findOrFail($id);
        $info['position'] = $positions ;
        $info['department'] = $positions->department;

        return view('admin.position.show',$info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->getInfo();
        $info['departments'] = Department::all();
        $info['position'] = Position::findOrFail($id);
        return view('admin.position.edit',$info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $position = Position::findOrFail($id);
        $position->update($request->all());
        return redirect()->route('position.index')->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $position = Position::find($id);
        $position->delete();
        return back()->with('error', 'Position deleted');
    }
}
