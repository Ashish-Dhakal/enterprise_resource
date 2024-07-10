<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    protected $title;

    public function getInfo()
    {
        $info['title'] = "Salary";
        return $info;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->getInfo();
        $info['employees'] = Employee::get();
        $info['salaries'] = Salary::paginate(5);
        return view("admin.salary.index", $info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->getInfo();
        $info['employees'] = Employee::get();

        return view('admin.salary.create', $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'effective_date' => 'required|date|after_or_equal:today',
            'amount' => 'required|string|max:8',
            'allowences' => 'required|string|max:8',
            'deduction' => 'required|string|max:8',
        ]);
        $allowences = $validatedData['allowences'];
        $deduction = $validatedData['deduction'];
        $amount = $validatedData['amount'];
        $total = ($amount+ $allowences) - $deduction ;

        $salary= Salary::create([
            'employee_id' => $validatedData['employee_id'],
            'effective_date' => $validatedData['effective_date'],
            'amount' => $amount,
            'allowences' => $allowences,
            'deduction' => $deduction,
            'total'=> $total ,
        ]);


        
        // $data = $request->all();
        // $salary = new Salary($data);
        $salary->save();
        return redirect()->route('salary.index')->with('message', 'Salary added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->getInfo();
        $info['employees'] = Employee::get();

        $info['salary'] = Salary::findOrFail($id);
        return view('admin.salary.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->getInfo();
        $info['employees'] = Employee::get();

        $info['salary']  = Salary::findOrFail($id);
        return view('admin.salary.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $salary = Salary::findOrFail($id);
        $salary->update($request->all());
        return redirect()->route('salary.index')->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $salary = Salary::find($id);
        $salary->delete();
        return back()->with('error', 'Salary deleted');
    }
}
