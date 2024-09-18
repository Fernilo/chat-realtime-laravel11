<?php

namespace App\Http\Controllers;

use App\Jobs\SendComment;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;

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
    {
        $comments = Comment::with('user')->where('service_id', $request->query('service_id'))->get();
        return response()->json($comments);
    }

    public function comment(Request $request): JsonResponse
    {
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->input('serviceId'),
            'message' => $request->input('comment'),
        ]);

        SendComment::dispatch($comment);

        return response()->json([
            'success' => true,
            'message' => "Comentario creado y job disparado"
        ]);
    }
}
