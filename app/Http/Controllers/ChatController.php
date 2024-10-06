<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('created_by_id', Auth::id())->get();
        dd($chats);
        return view('chat.index', [
            'chats' => $chats
        ]);
    }
    
}
