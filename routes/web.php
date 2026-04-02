<?php

use App\Http\Controllers\ModerationController;
use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\WebappController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebappController::class, 'index']);
Route::get('/create', [WebappController::class, 'create']);
Route::post('/store', [WebappController::class, 'store']);

//Route::get('/moderation', [SolicitacaoController::class, 'index']);
Route::get('/moderation', [ModerationController::class, 'index']);
Route::get('/aprovar/{webapp}', [ModerationController::class, 'aprovar']);
Route::put('/aprovado/{webapp}', [ModerationController::class, 'update']);