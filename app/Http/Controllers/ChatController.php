<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function startChat(Request $request)
    {
         // Crear un nuevo chat
        $chat = Chat::create([
            'created_by' => Auth::id(), // Usuario que inicia el chat
        ]);
    }
}
