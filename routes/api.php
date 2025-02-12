<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\AlumneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::post('users', function (Request $request) {
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json($user, 201);
});

Route::post('auth', function (Request $request) {
    $request->validate([
        'email'       => 'required|email',
        'password'    => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json(['token' => $token], 200);
});

Route::middleware('api')->group(function () {
    // Endpoint to retrieve all classes: GET /classes
    Route::get('classes', [ClasseController::class, 'index']);
    
    // Protegiu les rutes que modifiquen dades amb auth:sanctum
    Route::middleware('auth:sanctum')->group(function () {
        // Endpoint per crear una nova classe: POST /classes
        Route::post('classes', [ClasseController::class, 'store']);

        // Endpoint per afegir un alumne a una classe: POST /classes/{classe}/alumnes
        Route::post('classes/{classe}/alumnes', [ClasseController::class, 'addAlumne']);
    });

    // Endpoint to retrieve all students of a class: GET /classes/{classe}/alumnes
    Route::get('classes/{classe}/alumnes', [ClasseController::class, 'getAlumnes']);
});
