<?php

use App\Http\Controllers\TextController;

Route::get('/text', [TextController::class, 'index']);
Route::post('/text', [TextController::class, 'store']);
