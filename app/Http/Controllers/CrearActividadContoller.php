<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\TramitesServicios;
use App\Models\Ejercicios;


class CrearActividadContoller extends Controller
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
        $tramites_servicios = TramitesServicios::from('tramites_servicios as A')
            ->join('cat_tramites_servicios as B', 'A.cat_tramite_servicio_id', '=', 'B.id')
            ->join('cat_tipo_tramites as C', 'A.cat_tipo_tramite_id', '=', 'C.id')
            ->select('A.id', 'B.titulo', 'B.descripcion', 'B.disponible')
            ->where('C.id', 1)
            ->get();

        foreach ($tramites_servicios as $tramite_servicio) {
            $tramite_servicio->disponible = $tramite_servicio->disponible == 1 ? true : false;
        }

        $declaraciones = TramitesServicios::from('tramites_servicios as A')
            ->join('cat_tramites_servicios as B', 'A.cat_tramite_servicio_id', '=', 'B.id')
            ->join('cat_tipo_tramites as C', 'A.cat_tipo_tramite_id', '=', 'C.id')
            ->select('A.id', 'B.titulo', 'B.descripcion', 'B.disponible')
            ->where('C.id', 2)
            ->get();

        foreach ($declaraciones as $declaracion) {
            $declaracion->disponible = $declaracion->disponible == 1 ? true : false;
        }

        $tipo_obligacion = TramitesServicios::from('tramites_servicios as A')
            ->join('cat_tramites_servicios as B', 'A.cat_tramite_servicio_id', '=', 'B.id')
            ->join('cat_tipo_tramites as C', 'A.cat_tipo_tramite_id', '=', 'C.id')
            ->select('A.id', 'B.titulo', 'B.descripcion', 'B.disponible')
            ->where('C.id', 3)
            ->get();

        foreach ($tipo_obligacion as $obligacion) {
            $obligacion->disponible = $obligacion->disponible == 1 ? true : false;
        }

        $tipo_declaracion =  TramitesServicios::from('tramites_servicios as A')
            ->join('cat_tramites_servicios as B', 'A.cat_tramite_servicio_id', '=', 'B.id')
            ->join('cat_tipo_tramites as C', 'A.cat_tipo_tramite_id', '=', 'C.id')
            ->select('A.id', 'B.titulo', 'B.descripcion', 'B.disponible')
            ->where('C.id', 4)
            ->get();


        $tiene_ejercicios = Ejercicios::where('creador_id', Auth::user()->id)->exists();

        return Inertia::render('Crear/Actividades/Index', [
            'tramites_servicios' => $tramites_servicios,
            'declaraciones' => $declaraciones,
            'tipo_obligacion' => $tipo_obligacion,
            'tipo_declaracion' => $tipo_declaracion,
            'tiene_ejercicios' => $tiene_ejercicios,
        ]);
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
}
