<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Leave;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class DepartmentController extends Controller
{
    /**
     * @var string
     */
    protected $title;

    public function getInfo()
    {
        $info['title'] = "Department";
        return $info;
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $info = $this->getInfo();
        $info['departments'] = Department::paginate(5);
        return view('admin.department.index',$info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->getInfo();
        return view('admin.department.create', $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $department = new Department($data);
        $department->save();

        return redirect()->route('department.index')->with('message', 'Department added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->getInfo();
        $info['department'] = Department::findOrFail($id);
        return view('admin.department.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->getInfo();
        $info['department'] = Department::findOrFail($id);
        return view('admin.department.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->update($request->all());
        return redirect()->route('department.index')->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department= Department::where('id',$id)->first();
        $department->delete();
        return back()->with('error', 'Department deleted');
    }
}
