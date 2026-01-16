<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;

Route::get('/me', [AuthController::class, 'me']
)->middleware('auth:sanctum');


//Authorizations routes
Route::post('/auth',[AuthController::class, 'authenticate']);
Route::delete('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/forgot-password',[AuthController::class, 'forgotPasswordRequest'])->middleware('guest');
Route::post('/reset-password/token',[AuthController::class, 'forgotPasswordReset'])->middleware('guest');
Route::get('/admin-list',[AuthController::class, 'adminList'])->middleware('auth:sanctum');
Route::get('/admin-access',[AuthController::class, 'adminAccess'])->middleware('auth:sanctum');

// Tickets routes
Route::get('/tickets',[TicketController::class, 'index'])->middleware('auth:sanctum');
Route::get('/tickets/show',[TicketController::class, 'show'])->middleware('auth:sanctum');
Route::post('/tickets',[TicketController::class, 'store'])->middleware('auth:sanctum');
Route::put('/tickets/{ticket}',[TicketController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/tickets/{ticket}',[TicketController::class, 'destroy'])->middleware('auth:sanctum');

//Categories toutes
Route::get('categories',[CategoryController::class, 'index'])->middleware('auth:sanctum');
Route::post('categories',[CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::put('categories/{category}',[CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('categories/{category}',[CategoryController::class, 'destroy'])->middleware('auth:sanctum');

// Answers routes
Route::get('/answers',[AnswerController::class, 'index'])->middleware('auth:sanctum');
Route::post('/answers',[AnswerController::class, 'store'])->middleware('auth:sanctum');
Route::put('/answers/{answer}',[AnswerController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/answers/{answer}',[AnswerController::class, 'destroy'])->middleware('auth:sanctum');

// Notes routes
Route::get('/notes',[NoteController::class, 'index'])->middleware('auth:sanctum');
Route::post('/notes',[NoteController::class, 'store'])->middleware('auth:sanctum');
Route::put('/notes/{note}',[NoteController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/notes/{note}',[NoteController::class, 'destroy'])->middleware('auth:sanctum');

// Users routes
Route::get('/users',[UserController::class, 'index'])->middleware('auth:sanctum');
Route::put('/users/{user}',[UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{user}',[UserController::class, 'delete'])->middleware('auth:sanctum');