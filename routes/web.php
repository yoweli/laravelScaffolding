<?php

use Yoweli\LaravelScaffold\Http\Controllers\ScaffoldingController;

Route::group(['namespace' => 'Yoweli\Yoscaffolding\Http\Controllers'], function (){
    Route::get('scaffold', [ScaffoldingController::class, 'index']);
    Route::any('add-project', [ScaffoldingController::class, 'addProject']);
    Route::any('add-model/{id}', [ScaffoldingController::class, 'addModel']);
    Route::any('edit-project/{id}', [ScaffoldingController::class, 'editProject']);
    Route::any('view-project/{id}', [ScaffoldingController::class, 'viewProject']);
    Route::any('delete-project/{id}', [ScaffoldingController::class, 'deleteProject']);
    Route::any('delete-model/{id}', [ScaffoldingController::class, 'deleteModel']);
    Route::get('process-project/{id}', [ScaffoldingController::class, 'processProject']);
});

