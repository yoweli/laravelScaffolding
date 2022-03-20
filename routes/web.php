<?php

use Yoweli\LaravelScaffold\Http\Controllers\ProjectController;
use Yoweli\LaravelScaffold\Http\Controllers\ScaffoldingController;
use Yoweli\LaravelScaffold\Http\Controllers\ModelController;

Route::group(['namespace' => 'Yoweli\Yoscaffolding\Http\Controllers'], function () {
    Route::get('scaffold', [ScaffoldingController::class, 'index']);
    Route::get('process-project/{id}', [ScaffoldingController::class, 'processProject']);
    Route::any('add-project', [ProjectController::class, 'addProject']);
    Route::any('delete-model/{id}', [ModelController::class, 'deleteModel']);
    Route::any('add-model/{id}', [ModelController::class, 'addModel']);
    Route::any('edit-project/{id}', [ProjectController::class, 'editProject']);
    Route::any('view-project/{id}', [ProjectController::class, 'viewProject']);
    Route::any('delete-project/{id}', [ProjectController::class, 'deleteProject']);
});

