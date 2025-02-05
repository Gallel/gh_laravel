<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\AlumneController;

Route::middleware('api')->group(function () {
    // Endpoint to retrieve all classes: GET /classes
    Route::get('classes', [ClasseController::class, 'index']);
    
    // Endpoint to create a new class: POST /classes
    Route::post('classes', [ClasseController::class, 'store']);
    
    // Endpoint to add a student to a class: POST /classes/{classe}/alumnes
    Route::post('classes/{classe}/alumnes', [ClasseController::class, 'addAlumne']);

    // Endpoint to retrieve all students of a class: GET /classes/{classe}/alumnes
    Route::get('classes/{classe}/alumnes', [ClasseController::class, 'getAlumnes']);
});
