<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Alumne;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Classe::with('alumnes')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'grup' => 'required|string|max:255',
            'nomTutor' => 'required|string|max:255',
        ]);

        $classe = Classe::create($request->all());

        return response()->json($classe, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Add a new student to the class.
     */
    public function addAlumne(Request $request, Classe $classe)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'cognom' => 'required|string|max:255',
            'dataNaixement' => 'required|date',
            'NIF' => 'required|string|max:255',
        ]);

        $alumne = new Alumne($request->all());
        $classe->alumnes()->save($alumne);

        return response()->json($alumne, 201);
    }

    /**
     * Get all students of the class.
     */
    public function getAlumnes(Classe $classe)
    {
        return response()->json($classe->alumnes, 200);
    }
}
