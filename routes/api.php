<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\AlumneController;

Route::middleware('api')->group(function () {
    Route::apiResource('classes', ClasseController::class);
    Route::apiResource('alumnes', AlumneController::class);

    // Endpoint per afegir un alumne a una classe
    Route::post('classes/{classe}/alumnes', [ClasseController::class, 'addAlumne']);

    // Endpoint per consultar tots els alumnes d'una classe
    Route::get('classes/{classe}/alumnes', [ClasseController::class, 'getAlumnes']);

    // Defineix les rutes de la teva API aquí
    Route::get('/example', function () {
        return response()->json(['message' => 'Hello, API!']);
    });
});
