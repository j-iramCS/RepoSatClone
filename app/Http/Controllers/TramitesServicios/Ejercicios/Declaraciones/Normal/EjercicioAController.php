<?php

namespace App\Http\Controllers\TramitesServicios\Ejercicios\Declaraciones\Normal;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use App\Models\Ejercicios;

class EjercicioAController extends Controller
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
        return Inertia::render('Declaraciones/Normal/A/Index', []);
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
        DB::beginTransaction();
        try {

            Ejercicios::create([
                'creador_id' => Auth::user()->id,
                'tipo_ejercicio_id' => 3,
                'datos' => json_encode($request->formEjercicio)
            ]);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Ejercicio creado exitosamente'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            response()->json([
                'status' => 'error',
                'message' => 'Error al crear el ejercicio: ' . $e->getMessage()
            ], 500);
        }
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
}
