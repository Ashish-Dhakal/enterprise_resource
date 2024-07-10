<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    protected $title;

    public function getInfo()
    {
        $info['title'] = "Setting";
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
        return view('user.setting.userprofile.index', $info);
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
    // public function update(Request $request, $id)
    // {
    //     // dd($request);

    //     $user = User::findOrFail($id); // Retrieve the existing user by ID

    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'hobbies' => 'required|string|max:255',
    //         'country' => 'required|string|max:20',
    //         'language' => 'required|string|max:20',
    //         'city' => 'required|string|max:20',
    //         'postalcode' => 'required|string|max:20',
    //         'number' => 'required|digits_between:9,10',
    //         // 'email' => 'required|email|unique:users,email,' . $user->id, 
    //         // 'goog_cal' => 'nullable|string|in:yes,no', 
    //         'about-you' => 'required|string|max:255',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     if ($request->hasfile('image')) {
    //         $file = $request->file('image');
    //         $extenstion = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $extenstion;
    //         $file->move('uploads/employee/', $filename);
    //         $user->employee->image = $filename;
    //     }

    //     // Update the user's personal details
    //     $user->employee->update([
    //         'personaldetail' => [
    //             'hobbies' => $validatedData['hobbies'],
    //             'country' => $validatedData['country'],
    //             'language' => $validatedData['language'],
    //             'city' => $validatedData['city'],
    //             'postalcode' => $validatedData['postalcode'],
    //             'about-you' => $validatedData['about-you'],
    //         ],
    //         'number' => $validatedData['number'],
    //     ]);
    //     return redirect()->back()->with('message', 'User settings updated successfully.');
    // }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Retrieve the existing user by ID

        // Validate the incoming request data
        $validatedData = $request->validate([
            // 'first_name' => 'required|string',
            'position' => 'nullable|string',
            'hobbies' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'dob' => 'required|date',
            'number' => 'required|string|max:20',
            'email' => 'required|string|email',
            'country' => 'required|string|max:20',
            'language' => 'required|string|max:20',
            'city' => 'required|string|max:20',
            'postalcode' => 'required|string|max:20',
            'about-you' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update image if present in the request
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/employee/', $filename);
            $user->employee->image = $filename;
        }

        // Update the user's personal details
        $user->employee->update([
            'personaldetail' => [
                'hobbies' => $validatedData['hobbies'],
                'country' => $validatedData['country'],
                'language' => $validatedData['language'],
                'city' => $validatedData['city'],
                'postalcode' => $validatedData['postalcode'],
                'about-you' => $validatedData['about-you'],
            ],
            'number' => $validatedData['number'],
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
