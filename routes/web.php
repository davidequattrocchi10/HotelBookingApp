<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [RoomController::class, 'index']);
