<template>
    <Main>
        <div v-if="!continuar">
            <div class="max-w-6xl mx-auto">
                <div class="relative mb-6">
                    <!-- Encabezado que funciona como trigger -->
                    <div class="border-l-4 border-blue-500 bg-white dark:bg-[#171b2e] rounded-t-lg p-4 dark:text-slate-50 flex justify-between items-center shadow-md cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-300"
                        :class="{ 'rounded-b-lg': !isOpen }" @click="toggleContent">
                        <div class="flex items-center gap-3">
                            <div class="transition-transform duration-300" :class="{ 'rotate-180': isOpen }">
                                <Icon icon="mdi:chevron-down" class="text-2xl text-indigo-500" />
                            </div>
                            <h1 class="text-2xl font-bold">Instrucciones</h1>
                        </div>
                        <div class="hidden md:block text-indigo-500 text-sm font-medium">
                            {{ isOpen ? 'Ocultar detalles' : 'Ver instrucciones completas' }}
                        </div>
                    </div>

                    <!-- Contenido con animación usando Transition -->
                    <div class="overflow-hidden transition-all duration-500 ease-in-out border-l-4 border-blue-500 bg-white dark:bg-[#171b2e] rounded-b-lg shadow-md"
                        :class="[isOpen ? 'max-h-[1000px] opacity-100' : 'max-h-0 opacity-0']">
                        <div class="px-6 pb-6 pt-2 dark:text-slate-50">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="flex-grow">
                                    <p class="mt-2 leading-relaxed">
                                        Lo que harás a continuación es un ejercicio con las respuestas correctas. Estas
                                        respuestas forman parte del ejercicio. Más adelante, podrás crear la actividad
                                        completa y seleccionar este ejercicio para integrarlo a tu actividad principal.
                                    </p>
                                    <p class="mt-2 leading-relaxed">
                                        A continuación, deberás llenar los datos correspondientes a tu declaración
                                        provisional o definitiva de impuestos federales. El proceso consta de tres
                                        apartados
                                        que deberás completar en orden. Cada uno se habilitará cuando hayas finalizado
                                        el
                                        anterior:
                                    </p>
                                    <p class="mt-4 leading-relaxed">
                                        Conforme completes cada sección da click en el boton <span
                                            class="text-indigo-500 font-bold">Continuar</span>, se marcará como validada
                                        con
                                        un icono verde si es que toda la información de ese apartado es correcta.
                                        Asegúrate
                                        de proporcionar información precisa y revisar antes de avanzar.
                                    </p>
                                </div>
                                <div
                                    class="min-w-[150px] md:min-w-[200px] lg:min-w-[250px] justify-center items-center hidden md:flex">
                                    <Icon icon="typcn:info" class="text-9xl text-indigo-500" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Header -->
                <div class="dark:text-white pb-6 rounded-t-lg">
                    <h1 class="text-2xl font-bold">
                        Declaración Provisional o Definitiva de Impuestos Federales
                    </h1>
                </div>

                <!-- Navigation Tabs -->
                <div class="flex gap-1 pb-6 flex-wrap">
                    <!-- Tab ISR -->
                    <button
                        class="relative py-3 px-6 font-medium flex gap-2 items-center justify-center rounded-lg dark:text-white shadow-md"
                        :class="[
                            activeTab === 'isr' ? 'border-2 bg-indigo-100 border-indigo-400 dark:bg-indigo-900/20 dark:border-indigo-400' : '',
                            tabsValidados.isr ? 'bg-green-300 border-green-400 dark:bg-green-400/50 dark:border-green-500' : '',
                        ]" @click="cambiarTab('isr')">
                        ISR
                        <Icon v-if="tabsValidados.isr" icon="hugeicons:checkmark-badge-03"
                            class="text-green-600 dark:text-green-300 text-xl" />
                        <Icon v-else icon="mdi:hand-pointing-down"
                            class="text-slate-950 dark:text-slate-50 text-2xl animate-bounce absolute -top-3" />
                    </button>

                    <!-- Tab IVA -->
                    <button
                        class="relative py-3 px-6 font-medium flex gap-2 items-center justify-center rounded-lg dark:text-white shadow-md"
                        :class="[
                            activeTab === 'iva' ? 'border-2 bg-indigo-100 border-indigo-400 dark:bg-indigo-900/20 dark:border-indigo-400' : '',
                            tabsValidados.iva ? 'bg-green-300 border-green-400 dark:bg-green-400/50 dark:border-green-500' : '',
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
                        class="relative py-3 px-6 font-medium flex gap-2 items-center justify-center rounded-lg dark:text-white shadow-md"
                        :class="[
                            activeTab === 'pagos' ? 'border-2 bg-indigo-100 border-indigo-400 dark:bg-indigo-900/20 dark:border-indigo-400' : '',
                            tabsValidados.pagos ? 'bg-green-300 border-green-400 dark:bg-green-400/50 dark:border-green-500' : '',
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
                <div class="">

                    <!-- ISR Tab -->
                    <div v-if="activeTab === 'isr'">
                        <h2 class="text-xl font-bold dark:text-white">
                            Determinación del Impuesto Sobre la Renta (ISR)
                        </h2>
                        <p class="dark:text-gray-300 text-gray-600 text-sm mb-4">
                            ISR personas fisicas, actividad empresarial y
                            profesional
                        </p>

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
                            <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
                                <div class="grid grid-cols-2 gap-4">
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
                                    <div class="col-span-2 md:col-span-1">
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
                                            " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                            clearable :required="true" />
                                    </div>
                                    <!-- INGRESO DEL PERIODO -->
                                    <div class="col-span-2 md:col-span-1">
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
                                            " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                            clearable :required="true" />
                                    </div>
                                    <!-- TOTAL DE INGRESOS -->
                                    <div class="col-span-2 md:col-span-1">
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
                                            " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                            clearable :required="true" />
                                    </div>
                                    <!-- TOTAL DE INGRESOS ACUMULABLES -->
                                    <div class="col-span-2 md:col-span-1">
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
                                            " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                            clearable :required="true" />
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
                                            " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                            clearable :required="true" />
                                    </div>
                                    <!-- COMPRAS Y GASTOS DEL PERIODO -->
                                    <div class="col-span-2 md:col-span-1">
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
                                            " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                            clearable :required="true" />
                                    </div>
                                    <!-- TOTAL DE COMPRAS Y GASTOS -->
                                    <div class="col-span-2 md:col-span-1">
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
                                            " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                            clearable :required="true" />
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
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
                                            " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                            clearable :required="true" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
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
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
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
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
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

                        <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
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
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
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

                        <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
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
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
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
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
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
                                    <Input type="number" v-model="formEjercicio.inputCantidadACargo2"
                                        custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
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
                                    <Input type="number" v-model="formEjercicio.inputImpuestoACargo2"
                                        custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
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

                        <div class="bg-white shadow-md dark:bg-[#171b2e] p-4 rounded-lg">
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
                                        " custom-class="mt-2" placeholder="Ingresa el valor correspondiente"
                                        clearable />
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
                                    <Input type="number" v-model="formEjercicio.inputCantidadACargo3"
                                        custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
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
                                    <Input type="number" v-model="formEjercicio.inputCantidadAPagar2"
                                        custom-class="mt-2" placeholder="Ingresa el valor correspondiente" clearable
                                        :required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex justify-end mt-4">
                <button
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg shadow transition-colors"
                    @click="guardar">
                    Continuar
                </button>
            </div>
        </div>

        <!-- Vispara indicar que completo el formulario y es hora del siguiente paso -->

        <div v-if="continuar">
            <div class="px-6 py-8">
                <div class="flex justify-center mb-6">
                    <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                        <Icon icon="hugeicons:award-01" class="text-green-700 dark:text-white text-3xl" />
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-4">
                    ¡Ejercicio completado!
                </h2>

                <p class="text-gray-600 dark:text-gray-300 text-center mb-8">
                    ¡Felicidades! Has completado el ejercicio con éxito.
                    ¿Qué te gustaría hacer ahora?
                </p>

                <div class="flex gap-2">


                    <div
                        class="group relative overflow-hidden p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16">
                        </div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                        </div>

                        <div class="flex flex-col h-full">

                            <h3 class="text-xl font-bold mb-2 dark:text-white">Crear otro Ejercicio</h3>
                            <p class="dark:text-white text-opacity-80 mb-4 flex-grow">
                                Si quieres realizar otro ejercicio, similar al que acabas de completar, puedes
                                hacerlo
                                desde aquí.
                            </p>

                            <div class="flex justify-between items-center mt-2 flex-wrap">
                                <Link :href="route('index.ejercicio.obligacion.a')"
                                    class="px-4 py-2 border border-blue-500 text-blue-600 font-medium rounded-lg hover:bg-opacity-90 flex items-center hover:scale-105 transition-transform">
                                <span>Nuevo</span>
                                <Icon icon="hugeicons:reload" class="ml-1" />
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div
                        class="group relative overflow-hidden p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16">
                        </div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                        </div>

                        <div class="flex flex-col h-full">

                            <h3 class="text-xl font-bold mb-2 dark:text-white">Inicio</h3>
                            <p class="dark:text-white text-opacity-80 mb-4 flex-grow">
                                Si ya no quieres continuar con el ejercicio, puedes regresar al inicio y .
                            </p>

                            <div class="flex justify-between items-center mt-2 flex-wrap">
                                <Link :href="route('dashboard')"
                                    class="px-4 py-2 border border-blue-500 text-blue-600 font-medium rounded-lg hover:bg-opacity-90 flex items-center hover:scale-105 transition-transform">
                                <span>Inicio</span>
                                <Icon icon="hugeicons:home-05" class="ml-1" />
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16">
                        </div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                        </div>

                        <div class="flex flex-col h-full">

                            <h3 class="text-xl font-bold mb-2 text-white">Continuar con el proceso</h3>
                            <p class="text-white text-opacity-80 mb-4 flex-grow">
                                Ya has completado el ejercicio, ahora puedes crear una activiadad para darle un
                                uso al ejercicio que has
                                realizado.
                            </p>

                            <div class="flex justify-between items-center mt-2 flex-wrap">
                                <Link :href="route('index.actividad.declaracion.a')"
                                    class="px-4 py-2 animate-bounce  bg-gray-50 dark:bg-slate-900 text-blue-600 font-medium rounded-lg hover:bg-opacity-90 flex items-center">
                                <span>Continuar</span>
                                <Icon icon="mdi:arrow-right" class="ml-1" />
                                </Link>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </Main>
</template>

<script setup lang="ts">

// Notificaciones Toastify
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import axios from 'axios';

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

const activeTab = ref<any>("isr"); // Estado actual
const continuar = ref<boolean>(false);

const tabsValidados = ref<any>({
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
const v$isr = useVuelidate(rulesIngresos, formEjercicio.value);
const v$iva = useVuelidate(rulesDeterminacion, formEjercicio.value);
const v$pagos = useVuelidate(rulesIVA, formEjercicio.value);

// Función para validar un tab específico
const validarTab = async (tab: string) => {
    const validador = {
        isr: v$isr,
        iva: v$iva,
        pagos: v$pagos
    }[tab];

    if (!validador) return false;

    const isValid = await validador.value.$validate();
    tabsValidados.value[tab] = isValid;

    // Invalidar solo los tabs siguientes si este no es válido
    if (!isValid) {
        const tabOrder = ["isr", "iva", "pagos"];
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

    const tabOrder = ["isr", "iva", "pagos"];
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
    const tabOrder = ["isr", "iva", "pagos"];
    const currentTab = activeTab.value;

    // 1. Validar solo el tab actual
    const validadorActual = {
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
        // console.log("✅ Todos los datos:", formEjercicio.value);
        // toast("¡Formulario completo!", {
        //     theme: "dark",
        //     type: "success"
        // });
        try {
            const response = await axios.post(route('store.ejercicio.obligacion.a'), {
                formEjercicio: formEjercicio.value,
            });

            toast("Formulario guardado con éxito", {
                theme: "dark",
                type: "success"
            });

            console.log(response.data);

            // Mostrar modal de éxito
            continuar.value = true;

        } catch (error) {
            toast("Error al guardar el formulario", {
                theme: "dark",
                type: "error"
            });
            console.error(error);

        }





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


// Estado para controlar si el contenido está visible
const isOpen = ref(false);
const toggleContent = () => {
    isOpen.value = !isOpen.value;
};

</script>

<style></style>
