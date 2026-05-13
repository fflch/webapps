<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::get('/webapps', [WebappController::class, 'index']);
Route::get('/webapps/create', [WebappController::class, 'create']);
Route::post('/webapps/store', [WebappController::class, 'store']);
Route::get('/webapps/{webapp}', [WebappController::class, 'show']);

