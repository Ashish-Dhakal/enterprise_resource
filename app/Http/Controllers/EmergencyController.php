<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmergencyController extends Controller
{
    protected $title;

    public function getInfo()
    {
        $info['title'] = "Emergency Contact";
        return $info;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->getInfo();
        $info['user'] = Auth::user();
        $info['user'] = User::where('id', auth()->user()->id)->with('employee')->first();
        return view('user.setting.emergency.index', $info);
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
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);

        $user = User::findOrFail($id); // Retrieve the existing user by ID

        // Validate the incoming request data
        $validatedData = $request->validate([
            'country' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'relationship' => 'required|string|max:20',
            'city' => 'required|string|max:20',
            'postalcode' => 'required|string|max:20',
        ]);

        // Update the user's personal details
        $user->employee->update([
            'emergencycontact' => [
                'city' => $validatedData['city'],
                'postalcode' => $validatedData['postalcode'],
                'gender' => $validatedData['gender'],
                'relationship' => $validatedData['relationship'],
                'country' => $validatedData['country'],
            ]
        ]);
        return redirect()->back()->with('message', 'User settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}
