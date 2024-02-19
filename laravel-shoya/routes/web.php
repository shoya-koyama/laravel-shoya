<?php

use App\Http\Controllers\TextController;

// ルートURLへのGETリクエスト
Route::get('/', [TextController::class, 'index']);

// '/text' へのGETリクエスト
Route::get('/text', [TextController::class, 'index']);

// '/text' へのPOSTリクエスト
Route::post('/text', [TextController::class, 'store']);

Route::delete('/text/{id}', [TextController::class, 'destroy']);

Route::get('/text/pdf', [TextController::class, 'exportPdf']);

Route::post('/post-random-text', [TextController::class, 'postRandomText'])->name('post.random.text');



