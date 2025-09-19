<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;

Route::get('/me', [AuthController::class, 'me']
)->middleware('auth:sanctum');

Route::post('/auth',[AuthController::class, 'authenticate']);

Route::get('/myTickets',[TicketController::class, 'index']);