<?php

namespace App\Http\Controllers;

use App\Models\Appreciation;
use App\Models\ChatMessage;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getInfo()
    {
        $info['title'] = "Chat";
        return $info;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userId = $request->get('user_id');
            $messages = ChatMessage::where(function ($query) use ($userId) {
                $query->where('from_user_id', auth()->id())
                    ->where('to_user_id', $userId);
            })->orWhere(function ($query) use ($userId) {
                $query->where('from_user_id', $userId)
                    ->where('to_user_id', auth()->id());
            })->orderBy('created_at', 'asc')->get();

            return response()->json($messages);
        }

        $data = $this->getInfo();
        $userId = $request->get('user_id');
        $data['active_user'] = null;
        if ($userId) {
            $data['active_user'] = User::findOrFail($userId);
            $data['messages'] = ChatMessage::where(function ($query) use ($userId) {
                $query->where('from_user_id', auth()->id())
                    ->where('to_user_id', $userId);
            })->orWhere(function ($query) use ($userId) {
                $query->where('from_user_id', $userId)
                    ->where('to_user_id', auth()->id());
            })->orderBy('created_at', 'asc')->get();
        }
        $data['users'] = User::where('id', '!=', Auth::id())->get();
        return view('admin.chat.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = ChatMessage::create([
            'body' => $request->input('body'),
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->input('to_user_id'),
        ]);
        return redirect()->route('chat.index', ['user_id' => $request->to_user_id]);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }

    public function fetchMessages(Request $request)
    {
        if ($request->ajax()) {
            $lastMessageId = $request->input('last_message_id', 0);
            $messages = ChatMessage::where('id', '>', $lastMessageId)
                ->where(function ($query) {
                    $query->where('from_user_id', Auth::id())
                        ->orWhere('to_user_id', Auth::id());
                })
                ->get();

            return response()->json($messages);
        }
    }

    public function storeMessage(Request $request)
    {
        if ($request->ajax()) {
            $message = ChatMessage::create([
                'body' => $request->input('body'),
                'from_user_id' => Auth::id(),
                'to_user_id' => $request->input('to_user_id'),
            ]);

            return response()->json($message);
        }
    }
}
