<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\CatTipoTramites;
use App\Models\CatTramitesServicios;
use App\Models\TramitesServicios;
use App\Models\Ejercicios;
use App\Models\TiposEjercicios;

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
            [
                'titulo' => 'Declaraciones y pagos personas físicas',
                'descripcion' => '',
                'disponible' => 1,
            ],
            [
                'titulo' => 'Declaraciones y pagos para empresas',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'RFC, personas',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'RFC, empresas',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Adeudos fiscales',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Facturación electrónica',
                'descripcion' => '',
                'disponible' => 0,
            ]
        ];

        $para_tramites = [
            [
                'titulo' => 'Provisionales y definitivas',
                'descripcion' => '',
                'disponible' => 1,
            ],
            [
                'titulo' => 'Declaraciones de plataformas tecnológicas',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Anual',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Informativas',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Visores',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Derechos, productos y aprovechamientos (DPA)',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Devoluciones y compensaciones',
                'descripcion' => '',
                'disponible' => 0,
            ]
        ];

        $para_tipos_obligaciones_declarar = [
            [
                'titulo' => 'ISR retenciones por salarios',
                'descripcion' => '',
                'disponible' => 0
            ],
            [
                'titulo' => 'ISR renteniones por asimilados a salarios',
                'descripcion' => '',
                'disponible' => 0
            ],
            [
                'titulo' => 'Impuesto al valor agregado. Personas fisicas',
                'descripcion' => '',
                'disponible' => 1
            ],
            [
                'titulo' => 'IVA retenciones',
                'descripcion' => '',
                'disponible' => 0
            ],
        ];

        $para_tipos_declaraciones = [
            [
                'titulo' => 'Normal',
                'descripcion' => '',
                'disponible' => 1,
            ],
            [
                'titulo' => 'Complementaria',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Normal por Corrección Fiscal',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Complementaria por Corrección Fiscal',
                'descripcion' => '',
                'disponible' => 0,
            ],
            [
                'titulo' => 'Complementaria por Dictamen',
                'descripcion' => '',
                'disponible' => 0,
            ],
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
            TramitesServicios::create([
                'cat_tramite_servicio_id' => CatTramitesServicios::where('titulo', $item['titulo'])->first()->id,
                'cat_tipo_tramite_id' => CatTipoTramites::where('tipo', 'Tramites y Servicios')->first()->id,
                'creador_id' => 1,
            ]);
        }

        foreach ($para_tramites as $item) {
            TramitesServicios::create([
                'cat_tramite_servicio_id' => CatTramitesServicios::where('titulo', $item['titulo'])->first()->id,
                'cat_tipo_tramite_id' => CatTipoTramites::where('tipo', 'Tramites')->first()->id,
                'creador_id' => 1,
            ]);
        }

        foreach ($para_tipos_obligaciones_declarar as $item) {
            TramitesServicios::create([
                'cat_tramite_servicio_id' => CatTramitesServicios::where('titulo', $item['titulo'])->first()->id,
                'cat_tipo_tramite_id' => CatTipoTramites::where('tipo', 'Tipos de obligaciones a declarar')->first()->id,
                'creador_id' => 1,
            ]);
        }

        foreach ($para_tipos_declaraciones as $item) {
            TramitesServicios::create([
                'cat_tramite_servicio_id' => CatTramitesServicios::where('titulo', $item['titulo'])->first()->id,
                'cat_tipo_tramite_id' => CatTipoTramites::where('tipo', 'Tipos de declaraciones')->first()->id,
                'creador_id' => 1,
            ]);
        }



        // Tipos Ejercicios
        $catalogo_tipos_ejercicios = [
            [
                'tipo' => 'ISR retenciones por salarios',
                'descripcion' => 'Declaracion Provisional',
            ],
            [
                'tipo' => 'ISR retenciones por asimilados a salarios',
                'descripcion' => 'Declaracion Provisional',
            ],
            [
                'tipo' => 'Impuesto al valor agregado. Personas fisicas',
                'descripcion' => 'Declaracion Provisional',
            ],
            [
                'tipo' => 'IVA retenciones',
                'descripcion' => 'Declaracion Provisional',
            ],
        ];

        foreach ($catalogo_tipos_ejercicios as $tipo) {
            TiposEjercicios::create($tipo);
        }
    }
}
