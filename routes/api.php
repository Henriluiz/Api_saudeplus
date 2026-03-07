<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthUserController;

Route::post('/register', [UsersController::class, 'store']);
Route::post('/login', [AuthUserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
        Route::patch('/update', [AuthUserController::class, 'updatePerfil']);
        Route::get('/perfil', [AuthUserController::class, 'perfil']);
        Route::post('/logout', [AuthUserController::class, 'logout']);
        Route::delete('/delete', [AuthUserController::class, 'excluirPerfil']);

});

