<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\Ejercicios;


class usersEjerciciosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('usersEjercicios/Index');
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
        //
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

    public function getData()
    {
        // Obtener el usuario autenticado
        $user = Auth::user()->id;

        // Obtener los ejercicios del usuario
        $ejercicios = Ejercicios::where('creador_id', $user)->get();
        $count_ejercicios = $ejercicios->count();

        return response()->json([
            'user' => $user,
            'ejercicios' => $ejercicios,
            'count_ejercicios' => $count_ejercicios,
        ]);
    }
}
