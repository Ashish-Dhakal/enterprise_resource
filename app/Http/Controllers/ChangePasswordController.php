<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    protected $title;

    public function getInfo()
    {
        $info['title'] = "Change Paaword";
        return $info;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = $this->getInfo();
        $info['user'] = Auth::user();
        return view('user.setting.changepassword.index', $info);
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
    //     $validatedData = $request->validate([
    //         'current_password' => 'required|string|max:20',
    //         'new_password' => 'required|string|max:20',
    //         'confirm_password' => 'required|string|max:20',
    //     ]);

    //     $current_password = $validatedData['current_password'];
    //     $new_password = $validatedData['new_password'];
    //     $confirm_password = $validatedData['confirm_password'];


    //     $user = User::find($id);
    //     $isFirstLogged = $user->is_first_logged;
    //     $temporaryPassword = $user->temporary_password;
    //     $password = $user->password;

    //     if($new_password===$confirm_password)
    //     {
    //         if($isFirstLogged==1)
    //         {
    //             write a code to save a password= newpassword and 
    //             update the temporaryPassword = null
    //             ads set $isFirstLogged = 0 in user table of that user

    //             return redirect()->route('changepassword.index')->with('message', 'Paaword changed successfully');
    //         }

    //         elseif ($current_password==$password){
    //             update the password field with $new_password of that user

    //             return redirect()->route('changepassword.index')->with('message', 'Paaword changed successfully');

    //         }

    //         else{
    //             return redirect()->route('changepassword.index')->with('error', 'CurrentPassword did not match.');
    //         }
    //     }
    //     else
    //     {
    //         return redirect()->route('changepassword.index')->with('error', 'Password did not match.');

    //     }
    // }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'current_password' => 'required|string|max:20',
            'new_password' => 'required|string|max:20',
            'confirm_password' => 'required|string|max:20',
        ]);

        $current_password = $validatedData['current_password'];
        $new_password = $validatedData['new_password'];
        $confirm_password = $validatedData['confirm_password'];

        $user = User::find($id);
        // if (!$user) {
        //     return redirect()->route('changepassword.index')->with('error', 'User not found.');
        // }

        $isFirstLogged = $user->is_first_logged;
        $temporaryPassword = $user->temporary_password;
        $password = $user->password;

        if ($new_password === $confirm_password)
         {
            if ($isFirstLogged == 1) 
            {

                $user->password = bcrypt($new_password);
                $user->temporary_password = null;
                $user->is_first_logged = '0'; 
                $user->save();

                return redirect()->route('changepassword.index')->with('message', 'Password changed successfully');
            }

             elseif (Hash::check($current_password, $password)) 
             
             {
                
                $user->password = bcrypt($new_password);
                $user->save();

                return redirect()->route('changepassword.index')->with('message', 'Password changed successfully');
            } 

            else 
            {
                return redirect()->route('changepassword.index')->with('error', 'Current password is incorrect.');
            }
        } 
        else 
        {
            return redirect()->route('changepassword.index')->with('error', 'Passwords do not match.');
        }

        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}
