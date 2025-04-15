<template>
    <Main>
        <div class="max-w-6xl mx-auto">

            <!--  -->
            <div class="px-6">
                <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-lg p-6 mb-6 dark:text-slate-50 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Insturcciones -->

                    <div class="col-span-2">
                        <h1 class="text-2xl font-bold">Instrucciones</h1>
                        <p class="mt-2 leading-relaxed">
                            A continuación, deberás llenar los datos correspondientes a tu declaración provisional o
                            definitiva de impuestos federales.
                            El proceso consta de cuatro apartados que deberás completar en orden. Cada uno se habilitará
                            cuando hayas finalizado el anterior:
                        </p>

                        <p class="mt-4 leading-relaxed">
                            Conforme completes cada sección da click en el boton <span class="text-indigo-500 font-bold">Continuar</span>, se marcará como validada con un icono verde si es que toda la información de ese apartado es correcta. Asegúrate de
                            proporcionar información precisa y revisar antes de avanzar.
                        </p>
                    </div>

                    <div class="min-w-[300px] justify-center items-center hidden md:flex">
                        <Icon icon="hugeicons:information-circle" class="text-9xl text-indigo-500" />
                    </div>

                </div>
            </div>


            <!-- Header -->
            <div class="dark:text-white px-6 pb-6 rounded-t-lg">
                <h1 class="text-2xl font-bold">
                    Declaración Provisional o Definitiva de Impuestos Federales
                </h1>
            </div>

            <!-- Navigation Tabs -->
            <div class="px-6 flex gap-1">
                <!-- Tab Identificación -->
                <button
                    class="relative py-3 px-6 font-medium flex gap-2 items-center justify-center rounded-lg dark:text-white"
                    :class="[
                        activeTab === 'identificacion' ? 'border-2 bg-indigo-100 border-indigo-400 dark:bg-indigo-900/20 dark:border-indigo-400' : '',
                        tabsValidados.identificacion ? 'bg-green-100 border-green-400 dark:bg-green-400/20 dark:border-green-500' : ''
                    ]" @click="cambiarTab('identificacion')">
                    IDENTIFICACIÓN
                    <Icon v-if="tabsValidados.identificacion" icon="hugeicons:checkmark-badge-03"
                        class="text-green-600 dark:text-green-300 text-xl" />
                    <Icon v-else icon="mdi:hand-pointing-down"
                        class="text-slate-950 dark:text-slate-50 text-2xl animate-bounce absolute -top-3" />
                </button>

                <!-- Tab ISR -->
                <button
                    class="relative py-3 px-6 font-medium flex gap-2 items-center justify-center rounded-lg dark:text-white"
                    :class="[
                        activeTab === 'isr' ? 'border-2 bg-indigo-100 border-indigo-400 dark:bg-indigo-900/20 dark:border-indigo-400' : '',
                        tabsValidados.isr ? 'bg-green-100 border-green-400 dark:bg-green-400/20 dark:border-green-500' : '',
                        !tabsValidados.identificacion ? 'opacity-50 cursor-not-allowed' : ''
                    ]" @click="tabsValidados.identificacion ? cambiarTab('isr') : null"
                    :disabled="!tabsValidados.identificacion">
                    ISR
                    <Icon v-if="!tabsValidados.identificacion" icon="hugeicons:square-lock-02"
                        class="text-gray-500 dark:text-gray-300 text-xl" />
                    <Icon v-else-if="tabsValidados.isr" icon="hugeicons:checkmark-badge-03"
                        class="text-green-600 dark:text-green-300 text-xl" />
                    <Icon v-else icon="mdi:hand-pointing-down"
                        class="text-slate-950 dark:text-slate-50 text-2xl animate-bounce absolute -top-3" />
                </button>

                <!-- Tab IVA -->
                <button
                    class="relative py-3 px-6 font-medium flex gap-2 items-center justify-center rounded-lg dark:text-white"
                    :class="[
                        activeTab === 'iva' ? 'border-2 bg-indigo-100 border-indigo-400 dark:bg-indigo-900/20 dark:border-indigo-400' : '',
                        tabsValidados.iva ? 'bg-green-100 border-green-400 dark:bg-green-400/20 dark:border-green-500' : '',
                        !tabsValidados.isr ? 'opacity-50 cursor-not-allowed' : ''
                    ]" @click="tabsValidados.isr ? cambiarTab('iva') : null" :disabled="!tabsValidados.isr">
                    IVA
                    <Icon v-if="!tabsValidados.isr" icon="hugeicons:square-lock-02"
                        class="text-gray-500 dark:text-gray-300 text-xl" />
                    <Icon v-else-if="tabsValidados.iva" icon="hugeicons:checkmark-badge-03"
                        class="text-green-600 dark:text-green-300 text-xl" />
                    <Icon v-else icon="mdi:hand-pointing-down"
                        class="text-slate-950 dark:text-slate-50 text-2xl animate-bounce absolute -top-3" />
                </button>

                <!-- Tab Pagos -->
                <button
                    class="relative py-3 px-6 font-medium flex gap-2 items-center justify-center rounded-lg dark:text-white"
                    :class="[
                        activeTab === 'pagos' ? 'border-2 bg-indigo-100 border-indigo-400 dark:bg-indigo-900/20 dark:border-indigo-400' : '',
                        tabsValidados.pagos ? 'bg-green-100 border-green-400 dark:bg-green-400/20 dark:border-green-500' : '',
                        !tabsValidados.iva ? 'opacity-50 cursor-not-allowed' : ''
                    ]" @click="tabsValidados.iva ? cambiarTab('pagos') : null" :disabled="!tabsValidados.iva">
                    DETALLES DE PAGO
                    <Icon v-if="!tabsValidados.iva" icon="hugeicons:square-lock-02"
                        class="text-gray-500 dark:text-gray-300 text-xl" />
                    <Icon v-else-if="tabsValidados.pagos" icon="hugeicons:checkmark-badge-03"
                        class="text-green-600 dark:text-green-300 text-xl" />
                    <Icon v-else icon="mdi:hand-pointing-down"
                        class="text-slate-950 dark:text-slate-50 text-2xl animate-bounce absolute -top-3" />
                </button>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Identificación Tab -->
                <div v-if="activeTab === 'identificacion'">
                    <h2 class="text-xl font-bold mb-4 dark:text-white">
                        Datos de Identificación
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            RFC
                                        </p>
                                        <Tooltip width="none" position="top"
                                            text="El RFC es un número único que identifica a cada contribuyente en México. Puedes inventar un RFC o puedes dejar el RFC por defecto.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="text" v-model="formEjercicio.inputRFC" custom-class="mt-2"
                                        placeholder="Ingrese su RFC" clearable default-value="XAXX010101000"
                                        :required="true" :rules="{
                                            maxLength: maxLength(13),
                                            minLength: minLength(13),
                                        }" />
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            CURP
                                        </p>
                                        <Tooltip width="none" position="top"
                                            text="La CURP es un código único que identifica a cada persona en México. Puedes inventar una CURP o puedes dejar la CURP por defecto.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="text" v-model="formEjercicio.inputCURP" custom-class="mt-2"
                                        placeholder="Ingrese su RFC" clearable default-value="XXXXXXXXXXXXXXXXXX"
                                        :required="true" :rules="{
                                            maxLength: maxLength(18),
                                            minLength: minLength(18),
                                        }" />
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Apellido Paterno
                                        </p>
                                        <Tooltip width="none" position="top"
                                            text="El apellido paterno es el primer apellido de la persona. Puedes inventar un apellido o puedes dejar el apellido por defecto.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="text" v-model="formEjercicio.inputApellidoPaterno
                                        " custom-class="mt-2" placeholder="Ingresa un apellido" clearable
                                        default-value="PPP" :required="true" :rules="{
                                            maxLength: maxLength(30),
                                            minLength: minLength(2),
                                        }" />
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Apellido Materno
                                        </p>
                                        <Tooltip width="none" position="top"
                                            text="El apellido materno es el segundo apellido de la persona. Puedes inventar un apellido o puedes dejar el apellido por defecto.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="text" v-model="formEjercicio.inputApellidoMaterno
                                        " custom-class="mt-2" placeholder="Ingresa un apellido" clearable
                                        default-value="MMM" :required="true" :rules="{
                                            maxLength: maxLength(30),
                                            minLength: minLength(2),
                                        }" />
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Nombre(s)
                                        </p>
                                        <Tooltip width="none" position="top"
                                            text="El nombre(s) es el nombre de la persona. Puedes inventar un nombre o puedes dejar el nombre por defecto.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="text" v-model="formEjercicio.inputNombres" custom-class="mt-2"
                                        placeholder="Ingresa un apellido" clearable default-value="NNN" :required="true"
                                        :rules="{
                                            maxLength: maxLength(30),
                                            minLength: minLength(2),
                                        }" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Tipo de declaración
                                    </p>
                                    <Tooltip width="none" position="top" text="Sin referencias">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <!-- selec -->
                                <Select v-model="formEjercicio.selectedTipoDeclaracion
                                    " :options="optionsTipoDeclaracion" :searchable="false"
                                    placeholder="Selecciona una declaración" :required="true" />
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Ejercicio
                                    </p>
                                    <Tooltip width="none" position="top" text="Sin referencias">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <!-- selec -->
                                <Select v-model="formEjercicio.selectedEjercicio" :options="optionsEjercicio"
                                    :searchable="false" placeholder="Selecciona un ejercicio" :required="true" />
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Periodo
                                    </p>
                                    <Tooltip width="none" position="top" text="Sin referencias">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <!-- selec -->
                                <Select v-model="formEjercicio.selectedPeriodo" :options="optionsPeriodo"
                                    :searchable="false" placeholder="Selecciona un periodo" :required="true" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ISR Tab -->
                <div v-if="activeTab === 'isr'">
                    <h2 class="text-xl font-bold dark:text-white">
                        Determinación del Impuesto Sobre la Renta (ISR)
                    </h2>
                    <p class="dark:text-gray-300 text-gray-600 text-sm mb-4">
                        ISR personas fisicas, actividad empresarial y
                        profesional
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- TUS INGRESOS FUERON OBTENIDO EN COPROPIEDAD O SOCIEDAD CONYUGAL -->
                                <div class="col-span-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            ¿Tus ingresos fueron obtenido en
                                            copropiedad o sociedad conyugal?
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="Los ingresos obtenidos en copropiedad o sociedad conyugal se refieren a aquellos ingresos generados a través de bienes que son propiedad de más de una persona. 1. Copropiedad: Cuando un bien, como una propiedad o un negocio, es propiedad conjunta de varias personas. Los ingresos generados por ese bien se distribuyen entre los copropietarios según la proporción de su participación en la propiedad. 2. Sociedad conyugal: En el caso del matrimonio bajo el régimen de sociedad conyugal, los bienes adquiridos durante el matrimonio son propiedad conjunta de ambos cónyuges. Por lo tanto, los ingresos generados por estos bienes también se consideran compartidos.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <!-- selec -->
                                    <Select v-model="formEjercicio.selectedIngresos" :options="optionsIngresos"
                                        :searchable="false" placeholder="Selecciona una opción" :required="true" />
                                </div>
                                <!-- INGRESO DE PERIODOS ANTERIORES -->
                                <div class="">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Ingreso de periodos anteriores
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="Los ingresos de periodos anteriores se refieren a los ingresos que fueron generados en periodos fiscales previos al actual, pero que por alguna razón no fueron declarados o reconocidos en su momento correspondiente. Estos pueden incluir ingresos que se descubrieron después de haber presentado las declaraciones anteriores, errores de cálculo, o ingresos que no se tuvieron en cuenta en el periodo fiscal correspondiente.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputIngresoPeriodoAnterior
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                                <!-- INGRESO DEL PERIODO -->
                                <div class="">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Ingreso del periodo
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="Los ingresos del periodo son los ingresos que se han generado y recibido durante el periodo fiscal actual que estás declarando. Estos ingresos pueden incluir diferentes tipos de entradas de dinero, dependiendo de la actividad económica que realices. 1. Ventas: Ingresos obtenidos por la venta de productos o servicios. 2. Honorarios: Pagos recibidos por servicios profesionales prestados. 3. Rentas: Ingresos por alquilar propiedades. 4. Intereses: Ingresos generados por inversiones o depósitos bancarios. 5. Dividendos: Ganancias distribuidas por participar en una sociedad o empresa.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputIngresoPeriodo
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                                <!-- TOTAL DE INGRESOS -->
                                <div class="">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Total de ingresos
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="El total de ingresos se refiere a la suma de todos los ingresos que has recibido durante un periodo fiscal específico.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputTotalIngresos
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                                <!-- TOTAL DE INGRESOS ACUMULABLES -->
                                <div class="">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Total de ingresos acumulables
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="El total de ingresos acumulables se refiere a la suma de todos los ingresos que son considerados para el cálculo del Impuesto Sobre la Renta (ISR). Los cuales son: 1. Ventas: Dinero recibido por la venta de bienes o servicios. 2. Honorarios: Pagos por servicios profesionales prestados. 3. Rentas: Dinero recibido por alquilar propiedades. 4. Intereses: Ganancias obtenidas de inversiones financieras o depósitos bancarios. 5. Dividendos: Distribuciones de ganancias por participar en una sociedad o empresa. 6. Otros ingresos: Cualquier otro tipo de ingreso relevante para tu actividad económica.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputTotalIngresosAcumulables
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                                <!-- COMPRAS Y GASTOS DE PERIODOS ANTERIORES -->
                                <div class="col-span-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Compras y gastos de periodos
                                            anteriores
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="Las compras y gastos del periodo se refieren a todas las adquisiciones y desembolsos que realizas durante un periodo fiscal determinado para llevar a cabo tus actividades económicas. Como lo son: 1. Compras de mercancías: Adquisición de bienes que luego serán vendidos o utilizados en la producción de otros bienes. 2. Gastos operativos: Incluye sueldos y salarios, renta de locales, servicios públicos (agua, luz, teléfono, internet), y otros gastos necesarios para el funcionamiento del negocio. 3. Gastos de publicidad: Desembolsos realizados en marketing y publicidad para promover tus productos o servicios. 4. Gastos administrativos: Costos relacionados con la administración del negocio, como material de oficina, seguros, y honorarios de consultores. 5. Gastos de transporte: Incluye gastos en gasolina, mantenimiento de vehículos, y transporte de mercancías. 6. Gastos financieros: Intereses y comisiones pagados por préstamos y créditos.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputComprasGastosPeriodoAnterior
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                                <!-- COMPRAS Y GASTOS DEL PERIODO -->
                                <div class="">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Compras y gastos del periodo
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="Las compras y gastos del periodo abarcan todas las adquisiciones y desembolsos realizados durante un periodo fiscal específico para llevar a cabo tus actividades económicas.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputComprasGastosPeriodo
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                                <!-- TOTAL DE COMPRAS Y GASTOS -->
                                <div class="">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Total de compras y gastos
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="El total de compras y gastos se refiere a la suma de todas las adquisiciones y desembolsos que has realizado durante un periodo fiscal específico. Este total incluye todos los tipos de compras y gastos necesarios para llevar a cabo tus actividades económicas y mantener tu negocio en funcionamiento.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputTotalComprasGastos
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- DEDUCCIÓN DE INVERSIONES DE EJERCICIOS ANTERIORES  -->
                                <div class="col-span-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Deducción de inversiones de
                                            ejercicios anteriores
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="Las deducciones de inversiones de ejercicios anteriores se refieren a las deducciones fiscales que puedes aplicar en el ejercicio fiscal actual, pero que corresponden a inversiones realizadas en años fiscales anteriores. Estas deducciones son importantes porque permiten disminuir la base gravable sobre la cual se calculan tus impuestos, lo que puede reducir el monto de impuestos a pagar. 1. Compra de activos fijos: Si compraste maquinaria o equipo hace varios años y esos activos se están depreciando con el tiempo, puedes deducir una parte de esa depreciación cada año en tus declaraciones fiscales. 2. Gastos de capital: Inversiones en mejoras a largo plazo en tu negocio, como remodelaciones o ampliaciones, también pueden ser deducidas en varios años fiscales.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputDeduccionInversionesEjercicioAnterior
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
                                </div>
                                <!-- DEDUCCIÓN INMEDIATA DE INVERSIONES -->
                                <div class="col-span-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Deducción inmediata de inversiones
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="La deducción inmediata de inversiones es un beneficio fiscal que permite a los contribuyentes deducir de manera acelerada el costo de las inversiones realizadas en activos fijos, como maquinaria, equipo, inmuebles y otras mejoras, en el mismo ejercicio fiscal en que se adquieren o se realizan. Este tipo de deducción es diferente de la depreciación normal, que se distribuye a lo largo de varios años.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputDeduccionInmediataInversiones
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
                                </div>
                                <!-- ¿TIENES FACILIDADES ADMINISTRATIVAS Y ESTÍMULOS DEDUCIBLES? -->
                                <div class="col-span-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            ¿Tienes facilidades administrativas
                                            y estímulos deducibles?
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="Las facilidades administrativas y estímulos deducibles en el contexto de las declaraciones provisionales se refieren a ciertas medidas administrativas y estímulos fiscales que puedes deducir para reducir tu base gravable. Estos pueden incluir: 1. Facilidades Administrativas: * Simplificación de trámites: Procedimientos más sencillos y menos burocráticos para cumplir con las obligaciones fiscales. * Menores obligaciones informativas: Reducción en la cantidad de información que debes reportar al SAT. 2. Estímulos Deducibles: *Créditos fiscales: Cantidades que puedes restar de tus impuestos a pagar, como créditos por investigación y desarrollo. *Deducciones especiales: Gastos que normalmente no podrías deducir, pero que, bajo ciertas condiciones, se permiten, como inversiones en energías renovables o tecnología. Estos beneficios están diseñados para incentivar ciertas conductas o inversiones por parte de los contribuyentes y para hacer más llevadero el cumplimiento de las obligaciones fiscales.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <!-- selec -->
                                    <Select v-model="formEjercicio.selectedDeduccionFacilidadesAdministrativas
                                        " :options="optionsIngresos" :searchable="false"
                                        placeholder="Selecciona una opción" :required="true" />
                                </div>
                                <!-- PARTICIPACIÓN DE LOS TRABAJADORES EN LAS UTILIDADES -->
                                <div class="col-span-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Participación de los trabajadores en
                                            las utilidades
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="La Participación de los Trabajadores en las Utilidades (PTU) es un derecho que tienen los trabajadores en México a recibir una parte de las ganancias que obtiene la empresa para la que trabajan. Este derecho está establecido en el artículo 123 de la Constitución Mexicana y en la Ley Federal del Trabajo.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputParticipacionTrabajadoresUtilidades
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
                                </div>
                                <!-- BASE GRAVABLE DEL PAGO -->
                                <div class="col-span-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm m-0 p-0 dark:text-white">
                                            Base gravable del pago provisional
                                        </p>
                                        <Tooltip width="none" position="bottom"
                                            text="La base gravable del pago provisional se refiere al monto sobre el cual se calcula el impuesto que debes pagar en cada declaración provisional. Es el resultado de restar ciertos conceptos a los ingresos acumulables, para determinar la cantidad sujeta a imposición.">
                                            <Icon icon="material-symbols:help"
                                                class="text-xl text-blue-500 cursor-pointer" />
                                        </Tooltip>
                                    </div>
                                    <Input type="number" v-model="formEjercicio.inputBaseGravablePagoProvisional
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- ISR CAUSADO  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        ISR causado
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="El ISR causado se refiere al monto del Impuesto Sobre la Renta que has generado o 'causado' como resultado de tus actividades económicas durante un periodo fiscal determinado. Este impuesto se calcula sobre la base gravable, que es el total de ingresos acumulables menos las deducciones autorizadas.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputISRcausado" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>
                            <!-- ISR RETENIDO DE PERIODOS ANTERIORES -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        ISR retenido de periodos anteriores
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="El ISR retenido de periodos anteriores se refiere al Impuesto Sobre la Renta (ISR) que ha sido retenido en años fiscales anteriores y que puede ser acreditado en la declaración actual. Este concepto es relevante principalmente para personas físicas y morales que han tenido ingresos sujetos a retención por parte de terceros, como clientes o pagadores.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputISRretenidoPeriodosAnteriores
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable />
                            </div>
                            <!-- ISR RETENIDO DEL PERIODO  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        ISR retenido del periodo
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="El ISR retenido del periodo se refiere al Impuesto Sobre la Renta que ha sido retenido por terceros durante el mismo periodo fiscal que estás declarando. Estos terceros pueden ser clientes o pagadores que tienen la obligación de retener una parte del pago que te realizan y enterarlo al SAT en tu nombre. Esta retención actúa como un pago anticipado de tu impuesto.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputISRretenidoPeriodo
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable />
                            </div>
                            <!-- IMPUESTO RETENIDO -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Impuesto retenido
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="El impuesto retenido se refiere a la porción del impuesto que un pagador (como un cliente o empleador) debe deducir del pago que realiza a otra persona (como un proveedor de servicios o empleado) y enterarlo al Sistema de Administración Tributaria (SAT) en nombre de esa persona. Esta retención de impuesto actúa como un pago anticipado del impuesto que la persona a la que se le retuvo debe declarar y pagar.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputImpuestoRetenido
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable />
                            </div>
                            <!-- ISR A CARGO -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        ISR a cargo
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="El ISR a cargo es el monto del Impuesto Sobre la Renta (ISR) que debes pagar al final de un periodo fiscal después de haber realizado los cálculos correspondientes. Este monto se determina tomando en cuenta la base gravable y aplicando las deducciones y acreditaciones permitidas. Básicamente, es la cantidad de ISR que resulta después de restar al ISR causado cualquier retención o acreditación que puedas aplicar.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputISRcargo" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- IVA Tab -->
                <div v-if="activeTab === 'iva'">
                    <h2 class="text-xl font-bold dark:text-white">
                        R122 ISR Personas Físicas, Actividad Empresarial y
                        Profesional
                    </h2>
                    <p class="dark:text-gray-300 text-gray-600 text-sm mb-4">
                        ISR personas fisicas, actividad empresarial y
                        profesional
                    </p>

                    <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- A CARGO -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        A Cargo
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputACargo" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>

                            <!-- PARTE ACTUALIZADA  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Parte Actualizada
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen R122 ISR Personas Físicas, Actividad Empresarial y Profesional, la parte actualizada se refiere a los ajustes realizados en las obligaciones fiscales debido a la inflación o cambios en los índices de precios. La actualización se aplica para mantener el valor real de las obligaciones fiscales en términos económicos y asegurar que las contribuciones se mantengan consistentes con el poder adquisitivo actual.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputParteActualizada
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                    :required="true" />
                            </div>

                            <!-- RECARGOS -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Recargos
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen R122 ISR Personas Físicas, Actividad Empresarial y Profesional, los recargos se refieren a las sanciones o multas que pueden aplicarse por incumplimientos fiscales, como la presentación tardía de declaraciones, el pago insuficiente de impuestos, o la falta de cumplimiento de otras obligaciones fiscales.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputRecargos" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>

                            <!-- TOTAL DE CONTRIBUCIONES -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Total de contribuciones
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el total de contribuciones se refiere a la suma total de todos los impuestos y aportaciones que un contribuyente debe pagar al SAT durante un periodo fiscal específico. Estas contribuciones pueden incluir: 1. Impuesto Sobre la Renta (ISR): El principal impuesto sobre los ingresos generados por la actividad empresarial o profesional. 2. Impuesto al Valor Agregado (IVA): Impuesto sobre las ventas de bienes y servicios. Se cobra al cliente, pero el contribuyente es responsable de enterarlo al SAT. 3. Aportaciones de seguridad social: Incluye las contribuciones al Instituto Mexicano del Seguro Social (IMSS) y otras instituciones de seguridad social, si aplica. 4. Otras contribuciones: Cualquier otro impuesto o contribución que sea relevante para la actividad económica específica del contribuyente.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputTotalContribuciones
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                    :required="true" />
                            </div>

                            <!-- TOTAL DE APLICACIONES -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Total de Aplicaciones
                                    </p>
                                    <Tooltip width="none" position="bottom" text="Sin referencias">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputTotalAplicaciones
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable />
                            </div>

                            <!-- CANTIDAD A CARGO -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Cantidad a Cargo
                                    </p>
                                    <Tooltip width="none" position="bottom" text="Sin referencias">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputCantidadACargo" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>

                            <!-- ¿OPTA POR PAGAR EN PARCIALIDADES? -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        ¿Opta por pagar en parcialidades?
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="Los ingresos obtenidos en copropiedad o sociedad conyugal se refieren a aquellos ingresos generados a través de bienes que son propiedad de más de una persona. 1. Copropiedad: Cuando un bien, como una propiedad o un negocio, es propiedad conjunta de varias personas. Los ingresos generados por ese bien se distribuyen entre los copropietarios según la proporción de su participación en la propiedad. 2. Sociedad conyugal: En el caso del matrimonio bajo el régimen de sociedad conyugal, los bienes adquiridos durante el matrimonio son propiedad conjunta de ambos cónyuges. Por lo tanto, los ingresos generados por estos bienes también se consideran compartidos.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <!-- selec -->
                                <Select v-model="formEjercicio.selectedOptaPagarParcialidades
                                    " :options="optionsIngresos" :searchable="false"
                                    placeholder="Selecciona una opción" :required="true" />
                            </div>

                            <!-- CANTIDAD A PAGAR -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Cantidad a Pagar
                                    </p>
                                    <Tooltip width="none" position="bottom" text="Sin referencias">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputCantidadAPagar" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold dark:text-white mt-5">
                        Determinación del Impuesto al Valor Agregado
                    </h2>
                    <p class="dark:text-gray-300 text-gray-600 text-sm mb-4">
                        Determinación del IVA
                    </p>

                    <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- ACTIVIDADES GRAVADAS A LA TASA DEL 16% -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Actividades gravadas a la tasa del 16%
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputActividadesGravadasTasa16
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                    :required="true" />
                            </div>

                            <!-- ACTIVIDADES GRAVADAS A LA TASA DEL 0% -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Actividades gravadas a la tasa del 0%
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputActividadesGravadasTasa0
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable />
                            </div>

                            <!-- ACTIVIDADES EXENTAS -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Actividades exentas
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputActividadesExentas
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable />
                            </div>

                            <!-- IVA COBRADO DEL PERIODO A LA TASA DEL16% -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        IVA cobrado del periodo a la tasa del
                                        16%
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputIVACobradoPeriodoTasa16
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                    :required="true" />
                            </div>

                            <!-- IVA ACREDITABLE DEL PERIODO -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        IVA acreditable del periodo
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputIVAAcreditablePeriodo
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                    :required="true" />
                            </div>

                            <!-- IVA RETENIDO -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        IVA retenido
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputIVARetenido" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable />
                            </div>

                            <!-- CANTIDAD A CARGO  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Cantidad a Cargo
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputCantidadACargo2" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>

                            <!-- IMPUESTO A CARGO  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Impuesto a Cargo
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputImpuestoACargo2" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagos Tab -->
                <div v-if="activeTab === 'pagos'">
                    <h2 class="text-xl font-bold dark:text-white">
                        Detalle de Pagos
                    </h2>
                    <p class="dark:text-gray-300 text-gray-600 text-sm mb-4">
                        R21 Impuesto al valor agregado
                    </p>

                    <div class="bg-gray-50 dark:bg-slate-800 p-4 rounded-lg border dark:border-none">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- A CARGO -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        A Cargo
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputACargo2" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>

                            <!-- PARTE ACTUALIZADA -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Parte Actualizada
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputParteActualizada2
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                    :required="true" />
                            </div>

                            <!-- RECARGOS -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Recargos
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputRecargos2" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>

                            <!-- TOTAL DE CONTRIBUCIONES  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Total de Contribuciones
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputTotalContribuciones2
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                    :required="true" />
                            </div>

                            <!-- TOTAL DE APLICACIONES  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Total de Aplicaciones
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputTotalAplicaciones2
                                    " custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable />
                            </div>

                            <!-- CANTIDAD A CARGO  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Cantidad a Cargo
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputCantidadACargo3" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>

                            <!-- CANTIDAD A PAGAR  -->
                            <div class="">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm m-0 p-0 dark:text-white">
                                        Cantidad a Pagar
                                    </p>
                                    <Tooltip width="none" position="bottom"
                                        text="En el régimen fiscal R122 ISR Personas Físicas, Actividad Empresarial y Profesional, el término 'a cargo' se refiere al monto del Impuesto Sobre la Renta (ISR) que resulta como obligación de pago del contribuyente después de realizar los cálculos correspondientes.">
                                        <Icon icon="material-symbols:help"
                                            class="text-xl text-blue-500 cursor-pointer" />
                                    </Tooltip>
                                </div>
                                <Input type="number" v-model="formEjercicio.inputCantidadAPagar2" custom-class="mt-2"
                                    placeholder="Ingresa el valor correspondiente" clearable :required="true" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex justify-end mt-4 px-6">
            <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg shadow transition-colors"
                @click="guardar">
                Continuar
            </button>
        </div>

        <!-- <button @click="showModal = true">Abrir Modal</button>

        <Modal :show="showModal" @close="showModal = false" title="Vista de tu Ejercicio" max-width="5xl">
        </Modal> -->
    </Main>
</template>

<script setup lang="ts">

// Notificaciones Toastify
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

// Composables
import { Icon } from "@iconify/vue";
import { ref, watch, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { helpers } from "@vuelidate/validators";

// Components
import Main from "@/Layouts/Main.vue";
import Tooltip from "@/Components/Tooltip.vue";
import Select from "@/Components/Select.vue";
import Input from "@/Components/Input.vue";
import Modal from "@/Components/Modal.vue";

const activeTab = ref<any>("identificacion"); // Estado
const showModal = ref(false); // Modal
const tabsValidados = ref<any>({
    identificacion: false,
    isr: false,
    iva: false,
    pagos: false
});

import { useVuelidate } from "@vuelidate/core";
import {
    required,
    minLength,
    maxLength,
    minValue,
    maxValue,
} from "@vuelidate/validators";

const formEjercicio = ref({
    inputRFC: "", // r
    inputCURP: "", // r

    inputApellidoPaterno: "", // r
    inputApellidoMaterno: "", // r
    inputNombres: "", // r

    selectedTipoDeclaracion: "", // r
    selectedEjercicio: "", // r
    selectedPeriodo: "", // r

    selectedIngresos: "", // r
    inputIngresoPeriodoAnterior: "", // r
    inputIngresoPeriodo: "", // r
    inputTotalIngresos: "", // r
    inputTotalIngresosAcumulables: "", // r
    inputComprasGastosPeriodoAnterior: "", // r
    inputComprasGastosPeriodo: "", // r
    inputTotalComprasGastos: "", // r

    inputDeduccionInversionesEjercicioAnterior: "",
    inputDeduccionInmediataInversiones: "",
    selectedDeduccionFacilidadesAdministrativas: "", // r
    inputParticipacionTrabajadoresUtilidades: "",
    inputBaseGravablePagoProvisional: "", // r

    inputISRcausado: "", // r
    inputISRretenidoPeriodosAnteriores: "",
    inputISRretenidoPeriodo: "",
    inputImpuestoRetenido: "",
    inputISRcargo: "", // r

    inputACargo: "", // r
    inputParteActualizada: "", // r
    inputRecargos: "", // r
    inputTotalContribuciones: "", // r
    inputTotalAplicaciones: "",
    inputCantidadACargo: "", // r
    selectedOptaPagarParcialidades: "", // r
    inputCantidadAPagar: "", // r

    inputActividadesGravadasTasa16: "", // r
    inputActividadesGravadasTasa0: "",
    inputActividadesExentas: "",
    inputIVACobradoPeriodoTasa16: "", // r
    inputIVAAcreditablePeriodo: "", // r
    inputIVARetenido: "",
    inputCantidadACargo2: "", // r
    inputImpuestoACargo2: "", // r

    inputACargo2: "", // r
    inputParteActualizada2: "", // r
    inputRecargos2: "", // r
    inputTotalContribuciones2: "", // r
    inputTotalAplicaciones2: "",
    inputCantidadACargo3: "", // r
    inputCantidadAPagar2: "", // r
});

// Definir reglas por tabs
const rulesIdentificacion = computed(() => ({
    inputRFC: {
        required,
        minLength: minLength(13),
        maxLength: maxLength(13),
    },
    inputCURP: {
        required,
        minLength: minLength(18),
        maxLength: maxLength(18),
    },
    inputApellidoPaterno: {
        required,
        minLength: minLength(2),
        maxLength: maxLength(50),
    },
    inputApellidoMaterno: {
        required,
        minLength: minLength(2),
        maxLength: maxLength(50),
    },
    inputNombres: {
        required,
        minLength: minLength(2),
        maxLength: maxLength(50),
    },
    selectedTipoDeclaracion: required,
    selectedEjercicio: required,
    selectedPeriodo: required,
}));

const rulesIngresos = computed(() => ({
    selectedIngresos: required,
    inputIngresoPeriodoAnterior: required,
    inputIngresoPeriodo: required,
    inputTotalIngresos: required,
    inputTotalIngresosAcumulables: required,
    inputComprasGastosPeriodoAnterior: required,
    inputComprasGastosPeriodo: required,
    inputTotalComprasGastos: required,
    inputDeduccionInversionesEjercicioAnterior: {},
    inputDeduccionInmediataInversiones: {},
    selectedDeduccionFacilidadesAdministrativas: required,
    inputParticipacionTrabajadoresUtilidades: {},
    inputBaseGravablePagoProvisional: required,
}));

const rulesDeterminacion = computed(() => ({
    inputISRcausado: required,
    inputISRretenidoPeriodosAnteriores: {},
    inputISRretenidoPeriodo: {},
    inputImpuestoRetenido: {},
    inputISRcargo: required,
    inputACargo: required,
    inputParteActualizada: required,
    inputRecargos: required,
    inputTotalContribuciones: required,
    inputTotalAplicaciones: {},
    inputCantidadACargo: required,
    selectedOptaPagarParcialidades: required,
    inputCantidadAPagar: required,
}));

const rulesIVA = computed(() => ({
    inputActividadesGravadasTasa16: required,
    inputActividadesGravadasTasa0: {},
    inputActividadesExentas: {},
    inputIVACobradoPeriodoTasa16: required,
    inputIVAAcreditablePeriodo: required,
    inputIVARetenido: {},
    inputCantidadACargo2: required,
    inputImpuestoACargo2: required,
    inputACargo2: required,
    inputParteActualizada2: required,
    inputRecargos2: required,
    inputTotalContribuciones2: required,
    inputTotalAplicaciones2: {},
    inputCantidadACargo3: required,
    inputCantidadAPagar2: required,
}));

// Crear validadores para cada tab
const v$Identificacion = useVuelidate(rulesIdentificacion, formEjercicio.value);
const v$isr = useVuelidate(rulesIngresos, formEjercicio.value);
const v$iva = useVuelidate(rulesDeterminacion, formEjercicio.value);
const v$pagos = useVuelidate(rulesIVA, formEjercicio.value);

// Función para validar un tab específico
const validarTab = async (tab: string) => {
    const validador = {
        identificacion: v$Identificacion,
        isr: v$isr,
        iva: v$iva,
        pagos: v$pagos
    }[tab];

    if (!validador) return false;

    const isValid = await validador.value.$validate();
    tabsValidados.value[tab] = isValid;

    // Invalidar solo los tabs siguientes si este no es válido
    if (!isValid) {
        const tabOrder = ["identificacion", "isr", "iva", "pagos"];
        const currentIndex = tabOrder.indexOf(tab);
        for (let i = currentIndex + 1; i < tabOrder.length; i++) {
            tabsValidados.value[tabOrder[i]] = false;
        }
    }

    return isValid;
};

// Función para cambiar de tab con validación selectiva
const cambiarTab = async (tabDestino: string) => {
    const tabActual = activeTab.value;
    if (tabActual === tabDestino) return;

    const tabOrder = ["identificacion", "isr", "iva", "pagos"];
    const currentIndex = tabOrder.indexOf(tabActual);
    const destIndex = tabOrder.indexOf(tabDestino);

    // Permitir volver atrás siempre
    if (destIndex < currentIndex) {
        activeTab.value = tabDestino;
        return;
    }

    // Validar solo si vamos hacia adelante
    const esValido = await validarTab(tabActual);
    if (esValido) {
        activeTab.value = tabDestino;
    } else {
        toast("Completa esta sección primero", {
            theme: "dark",
            type: "error"
        });
    }
};

// GUARDAR
const guardar = async () => {
    const tabOrder = ["identificacion", "isr", "iva", "pagos"];
    const currentTab = activeTab.value;

    // 1. Validar solo el tab actual
    const validadorActual = {
        identificacion: v$Identificacion,
        isr: v$isr,
        iva: v$iva,
        pagos: v$pagos
    }[currentTab as string];

    if (validadorActual) {
        // Validar sin reset para no perder datos
        const validoActual = await validadorActual.value.$validate();
        tabsValidados.value[currentTab] = validoActual;

        if (!validoActual) {
            toast(`Hay errores en "${currentTab}" revisa los campos que faltan`, {
                theme: "dark",
                type: "error"
            });
            return;
        }
    }

    // 2. Verificar si todos los tabs están completos
    const todosCompletos = tabOrder.every(tab => tabsValidados.value[tab]);

    if (todosCompletos) {
        console.log("✅ Todos los datos:", formEjercicio.value);
        toast("¡Formulario completo!", {
            theme: "dark",
            type: "success"
        });





    } else {
        // 3. Encontrar el primer tab incompleto
        const siguienteTabIncompleto = tabOrder.find(tab => !tabsValidados.value[tab]);

        if (siguienteTabIncompleto) {
            activeTab.value = siguienteTabIncompleto;
            toast(`Completa ${siguienteTabIncompleto.toUpperCase()}`, {
                theme: "dark",
                type: "warning"
            });
        }
    }
};

const optionsTipoDeclaracion = ref([{ value: "1", label: "Normal" }]);
const optionsEjercicio = ref([
    { value: "2016", label: "2016" },
    { value: "2017", label: "2017" },
    { value: "2018", label: "2018" },
    { value: "2019", label: "2019" },
    { value: "2020", label: "2020" },
    { value: "2021", label: "2021" },
    { value: "2022", label: "2022" },
    { value: "2023", label: "2023" },
    { value: "2024", label: "2024" },
    { value: "2025", label: "2025" },
]);
const optionsPeriodo = ref([
    { value: "enero", label: "Enero" },
    { value: "febrero", label: "Febrero" },
    { value: "marzo", label: "Marzo" },
    { value: "abril", label: "Abril" },
    { value: "mayo", label: "Mayo" },
    { value: "junio", label: "Junio" },
    { value: "julio", label: "Julio" },
    { value: "agosto", label: "Agosto" },
    { value: "septiembre", label: "Septiembre" },
    { value: "octubre", label: "Octubre" },
    { value: "noviembre", label: "Noviembre" },
    { value: "diciembre", label: "Diciembre" },
]);
const optionsIngresos = ref([
    { value: "si", label: "Sí" },
    { value: "no", label: "No" },
]);

// Funciones de cálculo
const calcularA = () => {
    const valorAnterior =
        (formEjercicio.value.inputIngresoPeriodoAnterior || "")
            .toString()
            .replace(/[^0-9.]/g, "") || "0";
    const valorActual =
        (formEjercicio.value.inputIngresoPeriodo || "")
            .toString()
            .replace(/[^0-9.]/g, "") || "0";
    const total = parseFloat(valorAnterior) + parseFloat(valorActual);
    formEjercicio.value.inputTotalIngresos = isNaN(total)
        ? "0"
        : total.toFixed(2);
    formEjercicio.value.inputTotalIngresosAcumulables = isNaN(total)
        ? "0"
        : total.toFixed(2);
};
const calcularB = () => {
    const valorAnterior =
        (formEjercicio.value.inputComprasGastosPeriodoAnterior || "")
            .toString()
            .replace(/[^0-9.]/g, "") || "0";
    const valorActual =
        (formEjercicio.value.inputComprasGastosPeriodo || "")
            .toString()
            .replace(/[^0-9.]/g, "") || "0";
    const total = parseFloat(valorAnterior) + parseFloat(valorActual);
    formEjercicio.value.inputTotalComprasGastos = isNaN(total)
        ? "0"
        : total.toFixed(2);
};
const calcularC = () => {
    const a =
        (formEjercicio.value.inputTotalIngresos || "")
            .toString()
            .replace(/[^0-9.]/g, "") || "0";
    const b =
        (formEjercicio.value.inputTotalComprasGastos || "")
            .toString()
            .replace(/[^0-9.]/g, "") || "0";
    const total = parseFloat(a) - parseFloat(b);
    formEjercicio.value.inputBaseGravablePagoProvisional = isNaN(total)
        ? "0"
        : total.toFixed(2);
};

watch(
    [
        () => formEjercicio.value.inputIngresoPeriodoAnterior,
        () => formEjercicio.value.inputIngresoPeriodo,
    ],
    () => {
        calcularA();
    },
    { immediate: true }
);

// Watcher para calcularB
watch(
    [
        () => formEjercicio.value.inputComprasGastosPeriodoAnterior,
        () => formEjercicio.value.inputComprasGastosPeriodo,
    ],
    () => {
        calcularB();
    },
    { immediate: true }
);

// Watcher para calcularC
watch(
    [
        () => formEjercicio.value.inputTotalIngresos,
        () => formEjercicio.value.inputTotalComprasGastos,
    ],
    () => {
        calcularC();
    },
    { immediate: true }
);

</script>

<style></style>
