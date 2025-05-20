<template>
    <Main>
        <div class="py-5 flex gap-1 text-gray-600 dark:text-gray-300">
            <Link :href="route('dashboard')" class="hover:text-blue-500 hover:underline">Inicio</Link>/
            <Link :href="route('index.crear.actividad')" class="hover:text-blue-500 hover:underline">Crear Actividad
            </Link>/
            <Link href="/" class="hover:text-blue-500 hover:underline font-bold text-blue-500">Declaración Anual
            </Link>/
        </div>

        <!-- SECCION 1 -->
        <section class="hidden">
            <!-- Encabezado -->
            <div class="border-b pb-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Declaración Anual</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 ld:grid-cols-3 gap-4 mt-4">
                    <Input type="text" v-model="input_1" label="Indica el Ejercicio" required
                        placeholder="Ejemplo. 2023" clearable />
                    <div>
                        <Select v-model="select_1" :options="opciones_1" :searchable="false" label="Tipo de declaración"
                            placeholder="Selecciona una opción" :required="true" />
                    </div>
                    <div>
                        <Select v-model="select_2" :options="opciones_2" :searchable="false" label="Periodo"
                            placeholder="Selecciona una opción" :required="true" />
                    </div>
                </div>
            </div>

            <!-- Sección de Ingresos a declarar -->
            <div class="mb-8">
                <h2 class="font-semibold text-gray-800 mb-4 text-2xl">Ingresos a declarar</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 ld:grid-cols-3 gap-4 items-start">
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input id="check_1" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_1" class="text-gray-700 cursor-pointer">Sueldos y salarios</label>
                        </div>
                        <div class="flex items-center">
                            <input id="check_2" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_2" class="text-gray-700 cursor-pointer">Arrendamiento</label>
                        </div>
                        <div class="flex items-center">
                            <input id="check_3" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_3" class="text-gray-700 cursor-pointer">Enajenación de bienes</label>
                        </div>
                        <div class="flex items-center">
                            <input id="check_4" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_4" class="text-gray-700 cursor-pointer">Adquisición de bienes</label>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center">
                            <!-- Intereses -->
                            <input id="check_5" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_5" class="text-gray-700 cursor-pointer">Intereses</label>
                        </div>
                        <div class="flex items-center">
                            <!-- Premios -->
                            <input id="check_6" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_6" class="text-gray-700 cursor-pointer">Premios</label>
                        </div>
                        <div class="flex items-center">
                            <!-- Dividendos -->
                            <input id="check_7" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_7" class="text-gray-700 cursor-pointer">Dividendos</label>
                        </div>
                        <div class="flex items-center">
                            <!-- Demás ingresos -->
                            <input id="check_8" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_8" class="text-gray-700 cursor-pointer">Demás ingresos</label>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center">
                            <input id="check_9" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2">
                            <label for="check_9" class="text-gray-700 cursor-pointer">Sólo datos informativos</label>
                        </div>
                        <!-- Actividades empresariales -->
                        <div class="mb-8">
                            <h3 class="text-md font-semibold text-gray-800 mb-2 mt-8 text-sm">Actividades empresariales
                                y servicios
                                profesionales
                            </h3>

                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <!-- Actividad empresarial y servicios profesionales (Honorarios) -->
                                    <input id="check_10" type="checkbox"
                                        class="rounded border-gray-300 text-blue-600 mr-2">
                                    <label for="check_10" class="text-gray-700 cursor-pointer">Actividad empresarial y
                                        servicios profesionales (Honorarios)</label>
                                </div>
                                <div class="flex items-center">
                                    <!-- Plataformas tecnológicas -->
                                    <input id="check_11" type="checkbox"
                                        class="rounded border-gray-300 text-blue-600 mr-2">
                                    <label for="check_11" class="text-gray-700 cursor-pointer">Plataformas
                                        tecnológicas</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Preguntas adicionales -->
            <div class="mb-8 grid grid-cols-1 lg:grid-cols-2 gap-2">
                <div>
                    <p class="text-gray-700">¿Obtuviste ingresos y pagaste impuestos en el extranjero o tienes
                        impuesto pendiente de acreditar?</p>
                    <Select v-model="select_3" :options="opciones_3" :searchable="false" label="Selecciona una opción"
                        placeholder="Selecciona una opción" :required="true" class="max-w-96" />
                </div>

                <div>
                    <p class="text-gray-700">¿Estás obligado a presentar la información sobre tu situación fiscal
                        (ISSIF) en términos del Art. 32-H del CFF?</p>
                    <Select v-model="select_4" :options="opciones_3" :searchable="false" label="Selecciona una opción"
                        placeholder="Selecciona una opción" :required="true" class="max-w-96" />
                </div>
            </div>

            <!-- Sección ISR REPRES -->
            <div class="">
                <div class="mt-2 flex items-center">
                    <input id="check_12" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2" />
                    <label for="check_12" class="text-gray-700 cursor-pointer">ISR REFIPRES</label>
                </div>
                <div class="mt-2 flex items-center">
                    <input id="check_13" type="checkbox" class="rounded border-gray-300 text-blue-600 mr-2" />
                    <label for="check_13" class="text-gray-700 cursor-pointer">Enajenación de acciones en bolsa de
                        valores</label>
                </div>
            </div>

            <!-- Boton Continuar -->
            <div class="flex justify-end ">
                <Link :href="route('index.crear.actividad')"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Continuar</Link>
            </div>
        </section>

        <!-- SECCION 2 -->
        <section class="">
            <!-- Tabs -->
            <div class="border-b dark:border-gray-600 mb-5 flex gap-1 flex-wrap">
                <button @click="tab = 1"
                    class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100" :class="tab === 1
                        ? 'bg-blue-500 text-white shadow-md'
                        : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                    Ingresos
                </button>
                <button @click="tab = 2"
                    class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100" :class="tab === 2
                        ? 'bg-blue-500 text-white shadow-md'
                        : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                    Deducciones personales
                </button>
                <button @click="tab = 3"
                    class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100" :class="tab === 3
                        ? 'bg-blue-500 text-white shadow-md'
                        : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                    Determinación
                </button>
                <button @click="tab = 4"
                    class="px-3 py-2 rounded-t-md active:scale-90 transition-transform duration-100" :class="tab === 4
                        ? 'bg-blue-500 text-white shadow-md'
                        : 'bg-gray-200 dark:bg-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-800'">
                    Pago
                </button>
            </div>

            <!-- Tabs contenido -->
            <div v-if="tab === 1" class="bg-white dark:bg-gray-800 rounded-md shadow-md overflow-hidden">
                <div @click="tab2 === 1 ? tab2 = 0 : tab2 = 1"
                    class="flex items-center gap-4 bg-gray-100 dark:bg-gray-800 dark:text-white p-4 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700">
                    <Icon icon="mingcute:group-3-fill" class="text-3xl text-green-600" />
                    <p class="font-bold">Sueldos, salarios y asimilados</p>
                </div>
                <div v-if="tab2 === 1" class="p-4 border-y dark:border-gray-600">
                    <p class="text-blue-500 font-bold mb-4">Ingresos</p>
                    <Input type="number" v-model="input_2" label="Ingreso anual" required placeholder="Ej. 1,000.00"
                        clearable class="max-w-96" />

                    <!-- Tabla -->
                    <div class="py-6 overflow-x-auto">
                        <DataTable :columns="columnsT1" :data="[]" :items-per-page="5">
                            <!-- Titulo -->
                            <template #title>
                                <Link :href="route('index.crear.actividad')"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit">
                                <Icon icon="mingcute:bookmark-add-fill" />
                                <span>Agregar</span>
                                </Link>
                            </template>
                            <!-- Contenido -->
                            <template #body="{ rows }">
                                <tr v-for="row in rows" :key="row.id">
                                    <td
                                        class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                        {{ row.name }}</td>
                                    <td
                                        class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                        <Link :href="route('panel.admin.permiso', row.id)"
                                            class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                        <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                        <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                        </Link>
                                    </td>
                                </tr>
                            </template>
                        </DataTable>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                        <Input type="number" v-model="input_3" label="Ingresos exentos" required
                            placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                        <Input type="number" v-model="input_4" label="Ingresos acumulables" required
                            placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                        <Input type="number" v-model="input_5" label="Subsidio para el empleo" required
                            placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                        <Input type="number" v-model="input_6" label="Impuesto retenido" required
                            placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                    </div>
                </div>

                <div @click="tab2 === 2 ? tab2 = 0 : tab2 = 2"
                    class="flex items-center gap-4 bg-gray-100 dark:bg-gray-800 dark:text-white p-4 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700">
                    <Icon icon="mingcute:chart-line-line" class="text-3xl text-green-600" />
                    <p class="font-bold">Intereses</p>
                </div>
                <div v-if="tab2 === 2" class="p-4 border-y dark:border-gray-600">
                    <p class="text-blue-500 font-bold mb-4">Ingresos</p>

                    <div class="rounded-md border">
                        <p class="px-6 py-2 bg-gray-200">A. Sistema financiero</p>
                        <div class="px-4 py-6">
                            <div class="pb-6 overflow-x-auto">
                                <DataTable :columns="columnsT1" :data="[]" :items-per-page="5">
                                    <!-- Titulo -->
                                    <template #title>
                                        <Link :href="route('index.crear.actividad')"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                        </Link>
                                    </template>
                                    <!-- Contenido -->
                                    <template #body="{ rows }">
                                        <tr v-for="row in rows" :key="row.id">
                                            <td
                                                class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                                {{ row.name }}</td>
                                            <td
                                                class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                                <Link :href="route('panel.admin.permiso', row.id)"
                                                    class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                                <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                                <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                                </Link>
                                            </td>
                                        </tr>
                                    </template>
                                </DataTable>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                                <Input type="number" v-model="input_7" label="Monto total de los intereses nominales"
                                    required placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                                <Input type="number" v-model="input_8" label="Monto total de los intereses reales"
                                    required placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                                <Input type="number" v-model="input_9" label="Monto total de la pérdida" required
                                    placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                                <Input type="number" v-model="input_10" label="Monto total del ISR retenido" required
                                    placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                            </div>
                        </div>
                    </div>

                    <div class="rounded-md border mt-4">
                        <p class="px-6 py-2 bg-gray-200">B. Sistema no financiero</p>
                        <div class="px-4 py-6">
                            <Select v-model="select_5" :options="opciones_3" :searchable="false"
                                label="¿Obtuviste ingresos provenientes del Sistema No Financiero?"
                                placeholder="Selecciona una opción" :required="true" class="max-w-96" />
                        </div>
                    </div>

                    <div class="rounded-md border mt-4">
                        <p class="px-6 py-2 bg-gray-200">C. Ingresos de retiros parciales por el seguro de separación
                            individualizado
                            (solo para empleados del sector gobierno)</p>
                        <div class="px-4 py-6">
                            <Select v-model="select_6" :options="opciones_3" :searchable="false"
                                label="¿Obtuviste ingresos de retiros parciales por el seguro de separación individualizado?"
                                placeholder="Selecciona una opción" :required="true" class="max-w-96" />
                        </div>
                    </div>

                    <div class="rounded-md border mt-4">
                        <p class="px-6 py-2 bg-gray-200">D. Resultado</p>
                        <div class="px-4 py-6">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                                <Input type="number" v-model="input_11" label="Total Intereses reales del ejercicio"
                                    required placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                                <Input type="number" v-model="input_12" label="Total pérdidas en el ejercicio" required
                                    placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                                <Input type="number" v-model="input_13" label="Total de intereses reales acumulables"
                                    required placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                                <Input type="number" v-model="input_14" label="Pérdida de ejercicios anteriores"
                                    required placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                                <Input type="number" v-model="input_15"
                                    label="Intereses reales acumulados del ejercicio" required
                                    placeholder="Ej. 1,000.00" clearable class="max-w-96" />
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <div v-if="tab === 2" class="bg-white dark:bg-gray-800 rounded-md shadow-md relative">
                <div
                    class="flex items-center gap-4 bg-gray-100 dark:bg-gray-800 dark:text-white p-4 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700">
                    <p class="font-bold">Deducciones personales</p>
                </div>

                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <Input type="number" v-model="input_16" label="Monto total deducible" required
                            placeholder="Ej. 1000.00" clearable class="max-w-96" />
                        <Input type="number" v-model="input_17" label="Monto total por deducir" required
                            placeholder="Ej. 1000.00" clearable class="max-w-96" />
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-4 mt-4 mb-4">
                        <div v-for="tipo in tipos_deducciones" :key="tipo.id" @click="card_selected = tipo.id"
                            class="cursor-pointer dark:bg-gray-800 dark:text-white border-2 border-blue-500 border-dashed p-4 rounded-md flex flex-col items-center justify-start active:scale-90 transition-all duration-100 hover:scale-105"
                            :class="card_selected === tipo.id ? 'bg-blue-500 dark:bg-blue-500 text-white' : 'bg-white text-gray-800'">
                            <Icon :icon="tipo.card_icon" class="text-5xl mb-2" />
                            <p class="text-center text-xs">{{ tipo.card_name }}</p>
                            <p class="text-sm">{{ tipo.card_count }}</p>
                        </div>
                    </div>

                    <Modal v-model:show="modal_1" title="Título del Modal" maxWidth="2xl" closeable
                        @close="modal_1 = false" :blurBackground="true" :roundedCorners="'lg'" animation="scale">
                        <p class="text-black">
                            Este es el contenido del modal. Puedes poner lo que quieras aquí, incluyendo otros
                            componentes.
                        </p>
                    </Modal>

                    <div class="mt-10">

                        <div v-if="card_selected === 1">

                            <div>
                                <h1 class="text-lg font-bold dark:text-white">Facturas identificadas como posibles
                                    deducciones
                                    personales</h1>
                                <p class="dark:text-white">A continuación, se muestran las facturas que el SAT tiene
                                    identificadas
                                    como
                                    posibles
                                    deducciones
                                    personales, favor de verificarlas antes de enviar tu declaración.</p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <Input type="number" v-model="input_18" label="Facturado" required
                                        placeholder="Ej. 1000.00" clearable class="max-w-96" />
                                    <Input type="number" v-model="input_19" label="Deducible" required
                                        placeholder="Ej. 1000.00" clearable class="max-w-96" />
                                    <label for="" class="dark:text-white">¿Aceptas y reconoces la información precargada
                                        de tus
                                        deducciones
                                        personales por
                                        Honorarios médicos, dentales y gastos hospitalarios?</label>
                                    <Select v-model="select_7" :options="opciones_3" :searchable="false"
                                        label="Selecciona una opción" placeholder="Selecciona una opción"
                                        :required="true" class="max-w-96" />
                                </div>
                            </div>

                            <h2 class="text-lg text-center mt-4">Horarios Médicos, Dentales y Gastos Hospotalarios</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 2">
                            <h2 class="ml-5 text-lg">Gastos Médicos por Incapacidad o Discapacidad</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 3">
                            <h2 class="ml-5 text-lg">Gastos funerales</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 4">
                            <h2 class="ml-5 text-lg">Donativos</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 5">
                            <h2 class="ml-5 text-lg">Intereses reales</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 6">
                            <h2 class="ml-5 text-lg">Aportaciones voluntarias y complementarias y planes personales de
                                retiro</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 7">
                            <h2 class="ml-5 text-lg">Primas por seguros de gastos médicos</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 8">
                            <h2 class="ml-5 text-lg">Transportación escolar</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 9">
                            <h2 class="ml-5 text-lg">Depósitos en cuentas especiales para el ahorro</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 10">
                            <h2 class="ml-5 text-lg">Colegiaturas</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                        <div v-if="card_selected === 11">
                            <h2 class="ml-5 text-lg">Deducciones personales eliminadas</h2>
                            <DataTable :columns="columnsT2" :data="[]" :items-per-page="5">
                                <!-- Titulo -->
                                <template #title>
                                    <button @click="modal_1 = true"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex gap-2 items-center w-fit active:scale-90 transition-all duration-100">
                                        <Icon icon="mingcute:bookmark-add-fill" />
                                        <span>Agregar</span>
                                    </button>
                                </template>
                                <!-- Contenido -->
                                <template #body="{ rows }">
                                    <tr v-for="row in rows" :key="row.id">
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden text-center">
                                            {{ row.name }}</td>
                                        <td
                                            class="px-2 py-1 text-sm text-gray-700 dark:text-gray-300 break-words whitespace-normal overflow-hidden flex gap-2 justify-center flex-wrap">
                                            <Link :href="route('panel.admin.permiso', row.id)"
                                                class="bg-gray-500 text-white px-2 py-2 flex gap-2 items-center justify-center rounded-md shadow-sm active:scale-90 transition-transform duration-100">
                                            <Icon icon="mingcute:settings-3-fill" class="text-xl" />
                                            <p class="m-0 p-0 font-bold text-md">Ajustes</p>
                                            </Link>
                                        </td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>

            </div>

            <div v-if="tab === 3" class="p-4 bg-white dark:bg-gray-800 rounded-md shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Determinación</h2>
                <!-- Contenido de la pestaña Determinación -->
                <p>Contenido de la pestaña Determinación</p>
            </div>

            <div v-if="tab === 4" class="p-4 bg-white dark:bg-gray-800 rounded-md shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pago</h2>
                <!-- Contenido de la pestaña Pago -->
                <p>Contenido de la pestaña Pago</p>
            </div>


        </section>







    </Main>
</template>

<script setup lang='ts'>
import Main from '@/Layouts/Main.vue';
import Input from '@/Components/Input.vue';
import Select from '@/Components/Select.vue';
import DataTable from '@/Components/DataTable.vue';
import Modal from '@/Components/Modal.vue';

import { Icon } from "@iconify/vue";
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const opciones_1 = ref([
    { value: "normal", label: "Normal" },
    { value: "complementaria", label: "Complementaria", disabled: true },
    { value: "normal_por_correccion_fiscal", label: "Normal por corrección fiscal", disabled: true },
    { value: "complementaria_por_correccion_fiscal", label: "Complementaria por corrección fiscal", disabled: true },
    { value: "complementaria_por_dictamen", label: "Complementaria por dictamen", disabled: true },
]);

const opciones_2 = ref([
    { value: "del_ejercicio", label: "Del Ejercicio" },
    { value: "del_ejercicio_por_defuncion", label: "Del ejercicio por Defunción", disabled: true },
]);

const opciones_3 = ref([
    { value: "si", label: "Sí" },
    { value: "no", label: "No" },
]);

// variables
const modal_1 = ref(false);
const card_selected = ref(1);

const tab = ref<number>(2);
const tab2 = ref<number>(0);

const input_1 = ref("");
const select_1 = ref("");
const select_2 = ref("");
const select_3 = ref("");
const select_4 = ref("");
const input_2 = ref("");
const input_3 = ref("");
const input_4 = ref("");
const input_5 = ref("");
const input_6 = ref("");
const input_7 = ref("");
const input_8 = ref("");
const input_9 = ref("");
const input_10 = ref("");
const input_11 = ref("");
const input_12 = ref("");
const input_13 = ref("");
const input_14 = ref("");
const input_15 = ref("");
const input_16 = ref("");
const input_17 = ref("");
const input_18 = ref("");
const input_19 = ref("");
const select_5 = ref("");
const select_6 = ref("");
const select_7 = ref("");


// <!-- RFC del retenedor	Nombre, denominación o razón social	Ingreso anual	Ingreso exento	Subsidio empleo	Retenciones ISR	¿Aceptas y reconoces la información precargada?	Validar/Eliminar	Alerta -->

const columnsT1 = [
    { key: '1', name: 'rfcRetenedor', label: 'RFC del retenedor' },
    { key: '2', name: 'NombredenominaciónRazónSocial', label: 'Nombre, denominación o razón social' },
    { key: '3', name: 'IngresoAnual', label: 'Ingreso anual' },
    { key: '4', name: 'IngresoExento', label: 'Ingreso exento' },
    { key: '5', name: 'SubsidioEmpleo', label: 'Subsidio empleo' },
    { key: '6', name: 'RetencionesISR', label: 'Retenciones ISR' },
    { key: '7', name: 'AceptasYReconocesLaInformacionPrecargada', label: '¿Aceptas y reconoces la información precargada?' },
    { key: '8', name: 'ValidarEliminar', label: 'Validar/Eliminar' },
    { key: '9', name: 'Alerta', label: 'Alerta' }
];

const tipos_deducciones = [
    {
        id: 1,
        card_name: 'Horarios Médicos, Dentales y Gastos Hospotalarios',
        card_count: 0,
        card_icon: 'mingcute:first-aid-kit-fill',
    },
    {
        id: 2,
        card_name: 'Gastos Médicos por Incapacidad o Discapacidad',
        card_count: 0,
        card_icon: 'mingcute:wheelchair-fill',
    },
    {
        id: 3,
        card_name: 'Gastos Funerales',
        card_count: 0,
        card_icon: 'mdi:coffin',
    },
    {
        id: 4,
        card_name: 'Donativos',
        card_count: 0,
        card_icon: 'mingcute:currency-dollar-fill',
    },
    {
        id: 5,
        card_name: 'Intereses Reales',
        card_count: 0,
        card_icon: 'mingcute:home-7-fill',
    },
    {
        id: 6,
        card_name: 'Aportaciones Voluntarias y Complementarias y Planes Personales de Retiro',
        card_count: 0,
        card_icon: 'mingcute:pig-fill',
    },
    {
        id: 7,
        card_name: 'Primas por Seguros de Gatos Médicos',
        card_count: 0,
        card_icon: 'mingcute:briefcase-fill',
    },
    {
        id: 8,
        card_name: 'Transportación Escolar',
        card_count: 0,
        card_icon: 'mingcute:bus-2-fill',
    },
    {
        id: 9,
        card_name: 'Depósitos en Cuentas Especiales para el Ahorro',
        card_count: 0,
        card_icon: 'mingcute:bank-line',
    },
    {
        id: 10,
        card_name: 'Colegiaturas',
        card_count: 0,
        card_icon: 'mingcute:school-fill',
    },
    {
        id: 11,
        card_name: 'Deducciones Personales Eliminadas',
        card_count: 0,
        card_icon: 'mingcute:cash-line',
    },
];

// Fecha emisión
// RFC del emisor
// Nombre, denominación o razón social
// Descripción
// Importe
// Monto deducible

const columnsT2 = [
    { key: '1', name: 'fechaemision', label: 'Fecha emisión' },
    { key: '2', name: 'rfcEmisor', label: 'RFC del emisor' },
    { key: '3', name: 'NombredenominaciónRazónSocial', label: 'Nombre, denominación o razón social' },
    { key: '4', name: 'Descripcion', label: 'Descripción' },
    { key: '5', name: 'Importe', label: 'Importe' },
    { key: '6', name: 'MontoDeducible', label: 'Monto deducible' }
]

</script>

<style scoped></style>