<?php
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

Route::get('posts', [PostController::class, 'index']);
Route::post('posts', [PostController::class, 'store']);
Route::post('posts/{post}/comments', [CommentController::class, 'store']);

