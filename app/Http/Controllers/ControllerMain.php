<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ControllerMain extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tramitesyservicios = [
            [
                'id' => 1,
                'titulo' => 'Declaraciones y pagos personas físicas',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => true,
            ],
            [
                'id' => 2,
                'titulo' => 'Declaraciones y pagos para empresas',
                'icono' => 'OfficeBuildingIcon',
                'color' => 'bg-purple-600',
                'colorText' => 'purple-800',
                'descripcion' => 'Gestiona declaraciones y pagos corporativos',
                'disponible' => false,
            ],
            [
                'id' => 3,
                'titulo' => 'RFC, personas',
                'icono' => 'UserIcon',
                'color' => 'bg-green-500',
                'colorText' => 'green-700',
                'descripcion' => 'Trámites relacionados con tu RFC como persona física',
                'disponible' => false,
            ],
            [
                'id' => 4,
                'titulo' => 'RFC, empresas',
                'icono' => 'DocumentIcon',
                'color' => 'bg-indigo-600',
                'colorText' => 'indigo-800',
                'descripcion' => 'Gestión de RFC para personas morales',
                'disponible' => false,
            ],
            [
                'id' => 5,
                'titulo' => 'Adeudos fiscales',
                'icono' => 'ExclamationCircleIcon',
                'color' => 'bg-red-500',
                'colorText' => 'red-700',
                'descripcion' => 'Consulta y paga tus adeudos fiscales',
                'disponible' => false,
            ],
            [
                'id' => 6,
                'titulo' => 'Facturación electrónica',
                'icono' => 'ReceiptTaxIcon',
                'color' => 'bg-amber-500',
                'colorText' => 'amber-700',
                'descripcion' => 'Emisión y gestión de facturas electrónicas',
                'disponible' => false,
            ],
        ];
        $declaraciones = [
            [
                'id' => 1,
                'titulo' => 'Provisionales y definitivas',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones provisionales y definitivas',
                'disponible' => true,
            ],
            [
                'id' => 2,
                'titulo' => 'Declaraciones de plataformas tecnológicas',
                'icono' => 'CloudIcon',
                'color' => 'bg-purple-600',
                'colorText' => 'purple-800',
                'descripcion' => 'Gestiona tus declaraciones de plataformas tecnológicas',
                'disponible' => false,
            ],
            [
                'id' => 3,
                'titulo' => 'Anual',
                'icono' => 'CalendarIcon',
                'color' => 'bg-green-500',
                'colorText' => 'green-700',
                'descripcion' => 'Realiza tu declaración anual',
                'disponible' => false,
            ],
            [
                'id' => 4,
                'titulo' => 'Informativas',
                'icono' => 'FileIcon',
                'color' => 'bg-indigo-600',
                'colorText' => 'indigo-800',
                'descripcion' => 'Presenta tus declaraciones informativas',
                'disponible' => false,
            ],
            [
                'id' => 5,
                'titulo' => 'Visores',
                'icono' => 'MagnifyingGlassIcon',
                'color' => 'bg-red-500',
                'colorText' => 'red-700',
                'descripcion' => 'Consulta tus visores fiscales',
                'disponible' => false,
            ],
            [
                'id' => 6,
                'titulo' => 'Derechos, productos y aprovechamientos (DPA)',
                'icono' => 'ScaleIcon',
                'color' => 'bg-amber-500',
                'colorText' => 'amber-700',
                'descripcion' => 'Gestiona tus derechos, productos y aprovechamientos',
                'disponible' => false,
            ],
            [
                'id' => 7,
                'titulo' => 'Devoluciones y compensaciones',
                'icono' => 'ArrowPathIcon',
                'color' => 'bg-orange-500',
                'colorText' => 'orange-700',
                'descripcion' => 'Solicita devoluciones y compensaciones fiscales',
                'disponible' => false,
            ],

        ];
        $regimeneimpuesto = [
            [
                'id' => 1,
                'titulo' => 'ISR e IVA RESICO',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 2,
                'titulo' => 'Retenciones por salarios y asimilados ejercicios 2022 en adelante',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 3,
                'titulo' => 'Actividad empresarial. PODEBI',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 4,
                'titulo' => 'Actividad empresarial y profesional ejercicios 2025 en adelante',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 5,
                'titulo' => 'Arrendamiento de Inmuebles ejercicios 2025 en adelante',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 6,
                'titulo' => 'IVA ejercicios 2025 en adelante',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 7,
                'titulo' => 'Actividad empresarial y servicios profesionales',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 8,
                'titulo' => 'Arrendamiento',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 9,
                'titulo' => 'IVA',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => true,
            ],
            [
                'id' => 10,
                'titulo' => 'IEPS por combustibles fósiles',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 11,
                'titulo' => 'IEPS por combustibles automotrices',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 12,
                'titulo' => 'IEPS por Enajenación de gasolinas y diésel',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 13,
                'titulo' => 'Impuesto sobre la renta (De los demás ingresos)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 14,
                'titulo' => 'Impuesto sobre la renta (Otras retenciones)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 15,
                'titulo' => 'Impuesto sobre la renta (Retenciones por pagos al extrangero)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 16,
                'titulo' => 'Impuesto sobre la renta (Salarios)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 17,
                'titulo' => 'Impuesto sobre la renta (Retenciones por premios)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 18,
                'titulo' => 'Impuesto sobre la renta (ISR enajenación de bienes)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 19,
                'titulo' => 'Impuesto sobre la renta (ISR personas físicas. Adquisición de bienes)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 20,
                'titulo' => 'Impuesto sobre la renta (ISR fedatarios públicos. Adquisición de Bienes)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 21,
                'titulo' => 'Impuesto sobre la renta (IVA actos accidentales)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 22,
                'titulo' => 'Impuesto sobre la renta (ISR enajenación de bienes inmuebles)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 23,
                'titulo' => 'Impuesto sobre la renta (ISR retenciones por premios)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
            [
                'id' => 24,
                'titulo' => 'Impuesto especial sobre producción y servicios (Retenciones)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 25,
                'titulo' => 'Impuesto especial sobre producción y servicios (Bebidas alcohólicas)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 26,
                'titulo' => 'Impuesto especial sobre producción y servicios (Cerveza)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 27,
                'titulo' => 'Impuesto especial sobre producción y servicios (Bebidas refrescantes)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 28,
                'titulo' => 'Impuesto especial sobre producción y servicios (Alcohol, alcohol desnaturalizado y mieles incristalizables)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 29,
                'titulo' => 'Impuesto especial sobre producción y servicios (Tabacos labrados)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 30,
                'titulo' => 'Impuesto especial sobre producción y servicios (Telecomunicaciones)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 31,
                'titulo' => 'Impuesto especial sobre producción y servicios (Juegos con apuestas y/o sorteos)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 32,
                'titulo' => 'Impuesto especial sobre producción y servicios (Bebidas energetizantes)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 33,
                'titulo' => 'Impuesto especial sobre producción y servicios (Bebidas saborizadas)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 34,
                'titulo' => 'Impuesto especial sobre producción y servicios (Plaguicidas)',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
            [
                'id' => 35,
                'titulo' => 'Impuesto especial sobre producción y servicios (Alimentos no básicos con alta densidad calórica)',
                'icono' => '',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                'descripcion' => '...',
                'disponible' => false,
            ],
        ];


        $iva = [ // IVA
            [
                'id' => 1,
                'titulo' => 'Declaración normal',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                // 'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => true,
            ],
            [
                'id' => 2,
                'titulo' => 'Declaración complementaria',
                'icono' => 'DocumentTextIcon',
                'color' => 'bg-blue-500',
                'colorText' => 'blue-700',
                // 'descripcion' => 'Presenta tus declaraciones y realiza pagos como persona física',
                'disponible' => false,
            ],
        ];

        return Inertia::render('Crear/Index', [
            'tramitesyservicios' => $tramitesyservicios,
            'declaraciones' => $declaraciones,
            'regimeneimpuesto' => $regimeneimpuesto,
            'iva' => $iva,
        ]);
    }


    public function ejercicioA()
    {
        return Inertia::render('Crear/EjercicioA');
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
