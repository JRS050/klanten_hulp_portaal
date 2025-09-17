<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/me', [AuthController::class, 'me']
)->middleware('auth:sanctum');

Route::post('/auth',[AuthController::class, 'authenticate']);