<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;

Route::view('login', 'pages.login')->name('view.login');

Route::post('login', [AuthenticationController::class, 'login'])
    ->name('login');

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout'])
        ->name('logout');

    Route::get('users', [UserController::class, 'index'])
        ->name('users');

    Route::post('users/{user}/initiate-chat', [UserController::class, 'initiateChat'])
        ->name('initiate-chat');

    Route::get('chat/{chat}', [ChatController::class, 'chat'])
        ->name('chat');

    Route::post('chat/{chat}/messages', [ChatController::class, 'sendMessage'])
        ->name('send-message');
});

Route::redirect('/', '/users');