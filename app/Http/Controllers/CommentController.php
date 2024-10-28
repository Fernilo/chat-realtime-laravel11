<?php

namespace App\Http\Controllers;

use App\Events\CreateChat;
use App\Jobs\SendComment;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CommentController extends Controller
{
    public function index(int $idUser, int $idService)
    {
        $user = User::where('id', $idUser)->firstOrFail();
        $service = Service::where('id', $idService)->firstOrFail();
  
        return view('comments.index', [
            'user' => $user,
            'service' => $service
        ]);
    }

    public function comments(Request $request): JsonResponse
    {dd($request);
       $comments =  Chat::with('comments')
            -where('created_by_id', $request)
            ->get();

            // Para los usurios creadores del chat obtengo el chat que coincida con creadte_by_id y service_id a partir de ahí obtengo los commments
            // Para los creadores del chat ya tengo el chat_id y ya recupero facilmente los comentarios
           
        return response()->json($comments);
    }

    public function comment(Request $request): JsonResponse
    {
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->input('serviceId'),
            'message' => $request->input('comment')
        ]);

        SendComment::dispatch($comment);

        return response()->json([
            'success' => true,
            'message' => "Comentario creado y job disparado"
        ]);
    }
}
