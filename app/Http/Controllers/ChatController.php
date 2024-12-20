<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ChatController extends Controller
{
    public function index(int $idUser,int $serviceId)
    {
        $chats = Chat::with('user')
            ->where('service_id', $serviceId)
            ->whereHas('service', function (Builder $query) use ($idUser) {
                $query->where('user_id', $idUser);
            })->get();
       
        return view('chat.index', [
            'chats' => $chats
        ]);
    }
    
}
