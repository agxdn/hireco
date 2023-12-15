<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Create a user token
Route::get('/user-token', function () {
    $user = \App\Models\User::find(1);
    $userService = resolve(\App\Services\UserService::class);

    return $userService->createApiToken($user);
})->name('create.app-token');
