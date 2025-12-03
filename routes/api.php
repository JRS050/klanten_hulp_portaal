<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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
Route::get('/tickets/show',[TicketController::class, 'show'])->middleware('auth:sanctum');
Route::post('/tickets',[TicketController::class, 'store'])->middleware('auth:sanctum');
Route::put('/tickets/{ticket}',[TicketController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/tickets/{ticket}',[TicketController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('categories',[CategoryController::class, 'index'])->middleware('auth:sanctum');
Route::post('categories',[CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::put('categories/{category}',[CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('categories/{category}',[CategoryController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/answers',[AnswerController::class, 'index'])->middleware('auth:sanctum');
Route::post('/answers',[AnswerController::class, 'store'])->middleware('auth:sanctum');
Route::put('/answers/{answer}',[AnswerController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/answers/{answer}',[AnswerController::class, 'destroy'])->middleware('auth:sanctum');
