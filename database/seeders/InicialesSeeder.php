<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CatTipoTramites;
use App\Models\CatTramitesServicios;
use App\Models\TramitesServicios;
use App\Models\TiposEjercicios;
use App\Models\CatYears;
use App\Models\CatPeriodicidades;
use App\Models\CatPeriodos;
use App\Models\PeriodosHasPeriodicidades;

class InicialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TIPOS
        $catalogo_tipos_tramites = [
            ['tipo' => 'Tramites y Servicios'],
            ['tipo' => 'Tramites'],
            ['tipo' => 'Tipos de obligaciones a declarar'],
            ['tipo' => 'Tipos de declaraciones'],
        ];

        foreach ($catalogo_tipos_tramites as $item) {
            CatTipoTramites::create($item);
        }

        // TRAMITES Y SERVICIOS
        $para_tramites_servicios = [
            ['titulo' => 'Declaraciones y pagos personas físicas', 'disponible' => 1],
            ['titulo' => 'Declaraciones y pagos para empresas', 'disponible' => 0],
            ['titulo' => 'RFC, personas', 'disponible' => 0],
            ['titulo' => 'RFC, empresas', 'disponible' => 0],
            ['titulo' => 'Adeudos fiscales', 'disponible' => 0],
            ['titulo' => 'Facturación electrónica', 'disponible' => 0]
        ];

        $para_tramites = [
            ['titulo' => 'Provisionales y definitivas', 'disponible' => 1],
            ['titulo' => 'Declaraciones de plataformas tecnológicas', 'disponible' => 0],
            ['titulo' => 'Anual', 'disponible' => 0],
            ['titulo' => 'Informativas', 'disponible' => 0],
            ['titulo' => 'Visores', 'disponible' => 0],
            ['titulo' => 'Derechos, productos y aprovechamientos (DPA)', 'disponible' => 0],
            ['titulo' => 'Devoluciones y compensaciones', 'disponible' => 0]
        ];

        $para_tipos_obligaciones_declarar = [
            ['titulo' => 'ISR retenciones por salarios', 'disponible' => 0],
            ['titulo' => 'ISR renteniones por asimilados a salarios', 'disponible' => 0],
            ['titulo' => 'Impuesto al valor agregado. Personas fisicas', 'disponible' => 1],
            ['titulo' => 'IVA retenciones', 'disponible' => 0],
        ];

        $para_tipos_declaraciones = [
            ['titulo' => 'Normal', 'disponible' => 1],
            ['titulo' => 'Complementaria', 'disponible' => 0],
            ['titulo' => 'Normal por Corrección Fiscal', 'disponible' => 0],
            ['titulo' => 'Complementaria por Corrección Fiscal', 'disponible' => 0],
            ['titulo' => 'Complementaria por Dictamen', 'disponible' => 0],
        ];

        foreach ($para_tramites_servicios as $item) {
            CatTramitesServicios::create($item);
        }
        foreach ($para_tramites as $item) {
            CatTramitesServicios::create($item);
        }
        foreach ($para_tipos_obligaciones_declarar as $item) {
            CatTramitesServicios::create($item);
        }
        foreach ($para_tipos_declaraciones as $item) {
            CatTramitesServicios::create($item);
        }

        // Agregar Su categoria a cada uno de los tramites y servicios
        foreach ($para_tramites_servicios as $item) {
            $catTipoTramiteId = CatTipoTramites::where('tipo', 'Tramites y Servicios')->first()->id;
            $catTramiteServicioId = CatTramitesServicios::where('titulo', $item['titulo'])->first()->id;

            TramitesServicios::create([
                'cat_tramite_servicio_id' => $catTramiteServicioId,
                'cat_tipo_tramite_id' => $catTipoTramiteId,
                'creador_id' => 1,
            ]);
        }

        foreach ($para_tramites as $item) {
            $catTipoTramiteId = CatTipoTramites::where('tipo', 'Tramites')->first()->id;
            $catTramiteServicioId = CatTramitesServicios::where('titulo', $item['titulo'])->first()->id;

            TramitesServicios::create([
                'cat_tramite_servicio_id' => $catTramiteServicioId,
                'cat_tipo_tramite_id' => $catTipoTramiteId,
                'creador_id' => 1,
            ]);
        }

        foreach ($para_tipos_obligaciones_declarar as $item) {
            $catTipoTramiteId = CatTipoTramites::where('tipo', 'Tipos de obligaciones a declarar')->first()->id;
            $catTramiteServicioId = CatTramitesServicios::where('titulo', $item['titulo'])->first()->id;

            TramitesServicios::create([
                'cat_tramite_servicio_id' => $catTramiteServicioId,
                'cat_tipo_tramite_id' => $catTipoTramiteId,
                'creador_id' => 1,
            ]);
        }

        foreach ($para_tipos_declaraciones as $item) {
            $catTipoTramiteId = CatTipoTramites::where('tipo', 'Tipos de declaraciones')->first()->id;
            $catTramiteServicioId = CatTramitesServicios::where('titulo', $item['titulo'])->first()->id;

            TramitesServicios::create([
                'cat_tramite_servicio_id' => $catTramiteServicioId,
                'cat_tipo_tramite_id' => $catTipoTramiteId,
                'creador_id' => 1,
            ]);
        }

        // Tipos Ejercicios
        $catalogo_tipos_ejercicios = [
            ['tipo' => 'ISR retenciones por salarios', 'descripcion' => 'Declaracion Provisional'],
            ['tipo' => 'ISR retenciones por asimilados a salarios', 'descripcion' => 'Declaracion Provisional'],
            ['tipo' => 'Impuesto al valor agregado. Personas fisicas', 'descripcion' => 'Declaracion Provisional'],
            ['tipo' => 'IVA retenciones', 'descripcion' => 'Declaracion Provisional'],
        ];

        foreach ($catalogo_tipos_ejercicios as $tipo) {
            TiposEjercicios::create($tipo);
        }

        // Años
        $catalogo_anios = [
            ['anio' => '2020'],
            ['anio' => '2021'],
            ['anio' => '2022'],
            ['anio' => '2023'],
            ['anio' => '2024'],
            ['anio' => '2025'],
        ];

        foreach ($catalogo_anios as $tipo) {
            CatYears::create($tipo);
        }

        // Catalogo de periodicidades
        $catalogo_periodicidades = [
            ['nombre' => 'Mensual'],
            ['nombre' => 'Trimestral'],
            ['nombre' => 'Semestral (A)'],
            ['nombre' => 'Bimestral'],
            ['nombre' => 'Sin periodo'],
        ];

        foreach ($catalogo_periodicidades as $tipo) {
            CatPeriodicidades::create($tipo);
        }

        // Catalogo de periodos
        $catalogo_periodos_mesual = [
            ['nombre' => 'Enero'],
            ['nombre' => 'Febrero'],
            ['nombre' => 'Marzo'],
            ['nombre' => 'Abril'],
            ['nombre' => 'Mayo'],
            ['nombre' => 'Junio'],
            ['nombre' => 'Julio'],
            ['nombre' => 'Agosto'],
            ['nombre' => 'Septiembre'],
            ['nombre' => 'Octubre'],
            ['nombre' => 'Noviembre'],
            ['nombre' => 'Diciembre'],
        ];

        // Crear y asociar los periodos
        foreach ($catalogo_periodos_mesual as $tipo) {
            $x = CatPeriodos::create($tipo);
            PeriodosHasPeriodicidades::create([
                'cat_periodo_id' => $x->id,
                'cat_periodicidad_id' => CatPeriodicidades::where('nombre', 'Mensual')->first()->id,
            ]);
        }
    }
}
