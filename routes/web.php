<?php

use App\Http\Controllers\DockerImageController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortainerController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\ImageVariableController;
use App\Http\Controllers\AppVariableController;
use App\Http\Controllers\GwdbController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::resource('webapps', WebappController::class)->except('destroy');
# Rotas adicionais para o webapp
Route::prefix('webapps')->group(function() {
    Route::get('/{webapp}/databases', [WebappController::class, 'databases'])->name('webapps.databases');
    Route::get('/{webapp}/buckets', [WebappController::class, 'buckets']);
});

Route::resource('appVariable', AppVariableController::class)->only(['update']);
Route::get('appVariable/{webapp}', [AppVariableController::class, 'show'])->name('appVariable.show');
Route::get('appVariable/{webapp}/refresh', [AppVariableController::class, 'refresh'])->name('appVariable.refresh');

Route::resource('dockerimages', DockerImageController::class);
Route::get('dockerimages/{dockerimage}/variables', [DockerImageController::class, 'variables'])->name('dockerimages.variables');

Route::resource('imageVariable', ImageVariableController::class)->only(['store', 'destroy']);

Route::resource('gwdb', GwdbController::class)->only(['edit', 'store', 'create', 'destroy']);
Route::get('gwdb/testconnection', [GwdbController::class, 'test_connection'])->name('gwdb.testconnection');

Route::post('/bucket/{webapp}', [BucketController::class, 'store'])->name('bucket.store');

Route::prefix('portainer')->group(function() {
    Route::get('/', [PortainerController::class, 'index']);
    Route::get('/{webapp}/store', [PortainerController::class, 'store']);
    Route::get('/{webapp}/update', [PortainerController::class, 'update']);
});
