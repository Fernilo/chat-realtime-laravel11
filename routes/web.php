<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ChatController;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('comments/{user_id}/{service_id}', [CommentController::class, 'index'])->name('comments.index');
    Route::get('comments', [CommentController::class, 'comments'])->name('comments');
    Route::post('comment', [CommentController::class, 'comment'])->name('comment');
    Route::get('dashboard',[HomeController::class, 'index']);
    Route::get('chats', [ChatController::class, 'index'])->name('chats.index');
});