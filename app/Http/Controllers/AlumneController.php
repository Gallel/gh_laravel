<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumne;

class AlumneController extends Controller
{
    /**
     * Display a listing of students.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Alumne::all();
    }

    /**
     * Show the form for creating a new student.
     *
     * (Not used in API context, but kept for compatibility.)
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created student in storage.
     *
     * This method accepts student data, validates it, creates a new student record,
     * and returns the created record in a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->only(['nom', 'cognom', 'dataNaixement', 'NIF', 'classe_id']);
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'cognom' => 'required|string|max:255',
            'dataNaixement' => 'required|date',
            'NIF' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id',
        ]);

        $alumne = Alumne::create($data);
        return response()->json($alumne, 200);
    }

    /**
     * Display the specified student.
     *
     * @param  \App\Models\Alumne  $alumne
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Alumne $alumne)
    {
        return response()->json($alumne, 200);
    }

    /**
     * Show the form for editing the specified student.
     *
     * (Not used in API context, but kept for compatibility.)
     *
     * @param  string  $id
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified student in storage.
     *
     * This method validates the incoming data, updates the student record,
     * and returns the updated student in a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumne  $alumne
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Alumne $alumne)
    {
        $data = $request->only(['nom', 'cognom', 'dataNaixement', 'NIF', 'classe_id']);
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'cognom' => 'required|string|max:255',
            'dataNaixement' => 'required|date',
            'NIF' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id',
        ]);

        $alumne->update($data);

        return response()->json($alumne, 200);
    }

    /**
     * Remove the specified student from storage.
     *
     * @param  \App\Models\Alumne  $alumne
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Alumne $alumne)
    {
        $alumne->delete();
        return response()->json(null, 204);
    }
}
