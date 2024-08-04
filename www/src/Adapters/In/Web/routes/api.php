<?php

use App\Adapters\In\Web\Controllers\Home\ShowMessageController;
use App\Adapters\In\Web\Controllers\Message\DeleteMessageController;
use App\Adapters\In\Web\Controllers\Message\FetchMessageController;
use App\Adapters\In\Web\Controllers\Message\FetchMessageSecureController;
use App\Adapters\In\Web\Controllers\Message\RegisterMessageController;
use App\Adapters\In\Web\Controllers\Message\ShowSharedMessageController;
use App\Adapters\In\Web\Controllers\Message\UpdateMessageController;
use App\Adapters\In\Web\Controllers\User\AuthenticateUserController;
use App\Adapters\In\Web\Controllers\User\FetchUserController;
use App\Adapters\In\Web\Controllers\User\RegisterUserController;
use App\Adapters\In\Web\Controllers\User\UpdateUserController;
use App\Infrastructure\Http\Route;

/**
 * Home
 */
Route::get("/", [ShowMessageController::class, 'handle']);

/**
 * User
 */
Route::post("/api/users/register", [RegisterUserController::class, 'handle']);
Route::post("/api/users/authenticate", [AuthenticateUserController::class, 'handle']);
Route::get("/api/users/fetch", [FetchUserController::class, 'handle'])->middlewares('auth');
Route::put('/api/users/update', [UpdateUserController::class, 'handle'])->middlewares('auth');

/**
 * Message
 */
Route::post('/api/messages/register', [RegisterMessageController::class, 'handle'])->middlewares('auth');
Route::get('/api/messages/fetch', [FetchMessageController::class, 'handle'])->middlewares('auth');
Route::post('/api/messages/secure/fetch', [FetchMessageSecureController::class, 'handle'])->middlewares('auth');
Route::put('/api/messages/update', [UpdateMessageController::class, 'handle'])->middlewares('auth');
Route::delete('/api/messages/delete', [DeleteMessageController::class, 'handle'])->middlewares('auth');
Route::post('/api/messages/shared/{id}/{id}', [ShowSharedMessageController::class, 'handle'])->middlewares('auth');
