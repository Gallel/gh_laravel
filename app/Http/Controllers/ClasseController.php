<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Alumne;

class ClasseController extends Controller
{
    /**
     * Display a listing of classes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Classe::with('alumnes')->get();
    }

    /**
     * Show the form for creating a new class.
     *
     * (Not used in API context, but kept for compatibility.)
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created class in storage.
     *
     * This method accepts class data, validates it, creates a new class record,
     * and returns the created record in a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Filter only the accepted fields
        $data = $request->only(['grup', 'nomTutor']);
        
        // Validate the fields
        $request->validate([
            'grup' => 'required|string|max:255',
            'nomTutor' => 'required|string|max:255',
        ]);

        $classe = Classe::create($data);

        // Return HTTP 200 OK with the created class
        return response()->json($classe, 200);
    }

    /**
     * Display the specified class.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified class.
     *
     * (Not used in API context, but kept for compatibility.)
     *
     * @param  string  $id
     * @return void
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified class in storage.
     *
     * This method validates the incoming data, updates the class record,
     * and returns the updated class in a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Classe $classe)
    {
        $data = $request->only(['grup', 'nomTutor']);
        
        $request->validate([
            'grup' => 'required|string|max:255',
            'nomTutor' => 'required|string|max:255',
        ]);

        $classe->update($data);

        return response()->json($classe, 200);
    }

    /**
     * Remove the specified class from storage.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return response()->json(null, 204);
    }

    /**
     * Add a new student to the class.
     *
     * This method accepts student data, validates it, creates a new student record
     * associated with the class, and returns the created student in a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAlumne(Request $request, Classe $classe)
    {
        $data = $request->only(['nom', 'cognom', 'dataNaixement', 'NIF']);
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'cognom' => 'required|string|max:255',
            'dataNaixement' => 'required|date',
            'NIF' => 'required|string|max:255',
        ]);

        $alumne = new Alumne($data);
        $classe->alumnes()->save($alumne);

        return response()->json($alumne, 200);
    }

    /**
     * Get all students of the class.
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAlumnes(Classe $classe)
    {
        return response()->json($classe->alumnes, 200);
    }
}
