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
Route::get('/admin-list',[AuthController::class, 'adminList'])->middleware('auth:sanctum');

Route::get('/tickets',[TicketController::class, 'index'])->middleware('auth:sanctum');
Route::post('/tickets',[TicketController::class, 'store'])->middleware('auth:sanctum');
Route::put('/tickets/{ticket}',[TicketController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/tickets/{ticket}',[TicketController::class, 'destroy'])->middleware('auth:sanctum');
Route::put('/tickets/{ticket}/assign',[TicketController::class, 'assign'])->middleware('auth:sanctum');