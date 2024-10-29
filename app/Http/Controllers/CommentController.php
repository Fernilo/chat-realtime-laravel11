<?php

namespace App\Http\Controllers;

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
    public function index(int $idUser, int $idService, int $created_by_id = null)
    {
        $user = User::findOrFail($idUser);
        $service = Service::findOrFail($idService);
        $var = $created_by_id ?? $idUser;
     
        return view('comments.index', [
            'user' => $user,
            'service' => $service,
            'created_by_id' => $created_by_id ?? $idUser
        ]);
    }

    public function comments(Request $request): JsonResponse
    {
       $comments =  Chat::where('created_by_id', $request->created_by_id)
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
            'message' => $request->input('comment')
        ]);

        SendComment::dispatch($comment);

        return response()->json([
            'success' => true,
            'message' => "Comentario creado y job disparado"
        ]);
    }
}
