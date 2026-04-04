<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ModerationController;
use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\WebappController;
use Illuminate\Support\Facades\Route;

//crud
Route::get('/', [WebappController::class, 'index']);
Route::get('/create', [WebappController::class, 'create']);
Route::post('/store', [WebappController::class, 'store']);

//solicitante
Route::get('/minhas-solicitacoes', [SolicitacaoController::class, 'index']);
Route::get('/edit/{webapp}', [SolicitacaoController::class, 'edit']);
Route::put('/update/{webapp}', [SolicitacaoController::class, 'update']);

//moderação
Route::get('/moderation', [ModerationController::class, 'index']);
Route::get('/aprovar/{webapp}', [ModerationController::class, 'aprovar']);
Route::put('/aprovado/{webapp}', [ModerationController::class, 'update']);
Route::put('/reprovar/{webapp}', [ModerationController::class, 'reprovar']);