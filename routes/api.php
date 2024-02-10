<?php

use App\Actions\MakeLogin;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', MakeLogin::class);
Route::middleware('auth:sanctum')
    ->apiResource('/task', TaskController::class);
