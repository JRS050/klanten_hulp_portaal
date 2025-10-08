<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;

Route::get('/me', [AuthController::class, 'me']
)->middleware('auth:sanctum');

Route::post('/auth',[AuthController::class, 'authenticate']);
Route::delete('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/forgot-password',[AuthController::class, 'forgotPasswordRequest'])->middleware('guest');

Route::post('/reset-password/token',[AuthController::class, 'forgotPasswordReset'])->middleware('guest');
Route::get('/myTickets',[TicketController::class, 'index']);