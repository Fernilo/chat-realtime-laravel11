<?php

namespace App\Http\Controllers;

use App\Events\ChatCreating;
use App\Jobs\SendComment;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use App\Models\Chat;

class CommentController extends Controller
{
    public function index(int $idUser, int $idService)
    {
        $user = User::findOrFail($idUser);
        $service = Service::findOrFail($idService);
        $chat = Chat::where('created_by_id', $idUser)->where('service_id', $idService)->first();

        if(!$chat && $service->user_id != $idUser) {
            event(new ChatCreating($idUser, $idService));
        
        }
        return view('comments.index', [
            'user' => $user,
            'service' => $service,
            'chat' => $chat,
        ]);
    }

    public function indexUserCreatorService(int $idUser, int $idService, Chat $chat)
    {
        $user = User::findOrFail($idUser);
        $service = Service::findOrFail($idService);
        
        return view('comments.index', [
            'user' => $user,
            'service' => $service,
            'chat' => $chat,
        ]);
    }

    public function comments(Request $request): JsonResponse
    {
       $comments =  Chat::where('created_by_id', $request->created_by_id)
       ->where('service_id', $request->service_id)
            ->first()
            ->comments()
            ->with('user')
            ->get();
          
        return response()->json($comments);
    }

    public function comment(Request $request): JsonResponse
    {
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->input('serviceId'),
            'message' => $request->input('comment'),
            'chat_id' => $request->input('chatId')
        ]);

        SendComment::dispatch($comment);

        return response()->json([
            'success' => true,
            'message' => "Comentario creado y job disparado"
        ]);
    }
}
