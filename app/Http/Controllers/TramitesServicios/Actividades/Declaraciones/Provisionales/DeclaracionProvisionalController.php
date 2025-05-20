<?php

namespace App\Http\Controllers\TramitesServicios\Actividades\Declaraciones\Anuales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\CatYears;
use App\Models\CatPeriodicidades;
use App\Models\CatPeriodos;
use App\Models\Ejercicios;
use App\Models\PeriodosHasPeriodicidades;
use App\Models\TramitesServicios;

class DeclaracionProvisionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $catalogo_anios = CatYears::from('cat_years as A')
            ->select(
                'A.id as value',
                'A.anio as label'
            )->get();

        $catalogo_periodicidades = CatPeriodicidades::from('cat_periodicidades as A')
            ->select(
                'A.id as value',
                'A.nombre as label'
            )
            ->get();

        $total_periodos = PeriodosHasPeriodicidades::from('periodos_has_periodicidades as A')
            ->join('cat_periodos as B', 'A.cat_periodo_id', '=', 'B.id')
            ->join('cat_periodicidades as C', 'A.cat_periodicidad_id', '=', 'C.id')
            ->select(
                'A.cat_periodo_id as periodo_id',
                'A.cat_periodicidad_id as periodicidad_id',
                'B.nombre as label',
                'B.id as value'
            )
            ->get();

        $tipos_declaracion =  TramitesServicios::from('tramites_servicios as A')
            ->join('cat_tramites_servicios as B', 'A.cat_tramite_servicio_id', '=', 'B.id')
            ->join('cat_tipo_tramites as C', 'A.cat_tipo_tramite_id', '=', 'C.id')
            ->select(
                'A.id as value',
                'B.titulo as label',
                'B.descripcion',
                'B.disponible'
            )
            ->where('C.id', 4)
            ->where('B.disponible', 1)
            ->get();

        $ejercicios_impuesto_valor_agregado = Ejercicios::from('ejercicios as A')
        ->join('tipos_ejercicios as B', 'A.tipo_ejercicio_id', '=', 'B.id')
        ->select(
            'A.id',
            'A.creador_id',
            'B.tipo',
            'B.descripcion',
            'A.datos as ejercicio_datos',
        )
        ->where('A.tipo_ejercicio_id', 3)
        ->get();

        // return Inertia::render('Actividades/Declaraciones/Normal/A/Index', [
        //     'catalogo_anios' => $catalogo_anios,
        //     'catalogo_periodicidades' => $catalogo_periodicidades,
        //     'total_periodos' => $total_periodos,
        //     'tipos_declaracion' => $tipos_declaracion,
        //     'ejercicios_impuesto_valor_agregado' => $ejercicios_impuesto_valor_agregado
        // ]);
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
