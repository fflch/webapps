<?php

use App\Http\Controllers\DockerImageController;
use App\Http\Controllers\GwmariadbController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortainerController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\ImageVariableController;
use App\Http\Controllers\AppVariableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::resource('webapps', WebappController::class)->except('destroy');
# Rotas adicionais para o webapp
Route::prefix('webapps')->name('webapps.')->group(function() {
    Route::get('/{webapp}/database/store', [GwmariadbController::class, 'store'])->name('database.store');
    Route::get('/{webapp}/bucket/store', [BucketController::class, 'store']);
});

Route::resource('appVariable', AppVariableController::class)->only(['update']);
Route::get('appVariable/{webapp}', [AppVariableController::class, 'show'])->name('appVariable.show');

Route::resource('dockerimages', DockerImageController::class);
Route::resource('imageVariable', ImageVariableController::class)->only(['store', 'destroy']);

Route::prefix('gwmariadb')->group(function () {
    Route::get('/', [GwmariadbController::class, 'index']);
    Route::get('/testconnection', [GwmariadbController::class, 'test_connection']);
    Route::get('/{appdatabase}', [GwmariadbController::class, 'show']);
    Route::put('/{appdatabase}/update', [GwmariadbController::class, 'update']);
    Route::delete('/{appdatabase}', [GwmariadbController::class, 'destroy']);
});

Route::prefix('bucket')->group(function() {
    Route::get('/test', [BucketController::class, 'test_connection']);
    Route::get('/{bucket}', [BucketController::class, 'show']);
    Route::delete('/{bucket}', [BucketController::class, 'destroy']);
});

Route::prefix('portainer')->group(function() {
    Route::get('/', [PortainerController::class, 'index']);
    Route::get('/{webapp}/store', [PortainerController::class, 'store']);
    Route::get('/{webapp}/update', [PortainerController::class, 'update']);
});
