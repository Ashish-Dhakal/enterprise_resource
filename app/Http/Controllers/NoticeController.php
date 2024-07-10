<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class NoticeController extends Controller
{
    protected $title;

    public function getInfo()
    {
        $info['title'] = "Notice";
        return $info;
    }

    //display the notice
    // public function index(Request $request)
    // {
    //     $info = $this->getInfo();
    //     // dd(auth()->user()->id);
    //     //        dd(Auth::user());
    //     $user = auth()->user()->id;

    //     if (Gate::allows('user-notice', auth()->user())) {
    //          $info['notices'] = Notice::get()->where('user_id', $user)
    //         ->whereNull('read_at');
    //         return view('admin.notice.index', $info);
    //     } 
    //     else 
    //     {
    //         $info = $this->getInfo();
    //         $info['notices'] = Notice::paginate(5);
    //         return view('admin.notice.index', $info);
    //     }
    // }

    public function index(Request $request)
    {
        $user = auth()->user();
        $info = $this->getInfo();

        if ($user->role == 'User' ) {
            $info['notices'] = Notice::where('user_id', $user->id)
            ->whereNull('read_at')
            ->get();
        } elseif ($user->role == 'Admin') {
            $info['notices'] = Notice::paginate(5);
        }

        return view('admin.notice.index', $info);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->getInfo();
        return view('admin.notice.create', $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
        ]);


        foreach (User::whereRole('user')->get() ?? [] as $user) {
            $notice = new Notice();
            $validatedData['user_id'] = $user->id;
            $notice->fill($validatedData);
            $notice->save();
        }



        return redirect()->route('notice.index')->with('message', 'Notice added successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {

    //     $info = $this->getInfo();
    //     $info['notice'] = Notice::findOrFail($id);
    //     return view('admin.notice.show', $info);
    // }

    public function show($id)
    {
        $info = $this->getInfo();
        $notice = Notice::findOrFail($id);

        if ($notice->read_at === null) {
            $notice->read_at = now();
            $notice->save(); 
        }

        $info['notice'] = $notice;
        return view('admin.notice.show', $info);


        
    //     else 
    //     {
    //         $info = $this->getInfo();
    //         $info['notices'] = Notice::paginate(5);
    //         return view('admin.notice.show', $info);
    // }
    }  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->getInfo();
        $info['notice'] = Notice::findOrFail($id);
        return view('admin.notice.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);
        $notice->update($request->all());
        return redirect()->route('notice.index')->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notice = Notice::find($id);
        $notice->delete();
        return back()->with('error', 'Notice deleted');
    }
}
