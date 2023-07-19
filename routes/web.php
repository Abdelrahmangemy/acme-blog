<?php

use Illuminate\Support\Facades\Route;

//post
Route::get('/', [App\Http\Controllers\Frontend\PostController::class, 'viewPost']);
Route::get('/{post_slug}', [App\Http\Controllers\Frontend\PostController::class, 'viewPostDetails']);

//comment
Route::post('comments', [App\Http\Controllers\Frontend\CommentController::class, 'store']);
Route::post('delete-comment', [App\Http\Controllers\Frontend\CommentController::class, 'destroy']);


Route::prefix('admin')->middleware('auth','isAdmin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('/posts', [App\Http\Controllers\Admin\PostController::class, 'index']);
    Route::get('/add-post', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('/add-post', [App\Http\Controllers\Admin\PostController::class, 'store']);
    Route::get('/post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::put('/update-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'update']);
    Route::get('/delete-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'destroy']);

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('/user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('/update-user/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
});

Auth::routes();
