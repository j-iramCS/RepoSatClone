<template>

    <Main>


        <div class="flex justify-end items-center space-x-4 p-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">Versión: 1.0.0</p>
        </div>


        <section class="h-[80vh] px-2 pt-2 pb-3 bg-white rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <div class="flex space-x-2 mb-2">
                    <button class="w-4 h-4 bg-red-500 rounded-full"></button>
                    <button class="w-4 h-4 bg-yellow-500 rounded-full"></button>
                    <button class="w-4 h-4 bg-green-500 rounded-full"></button>
                </div>
                <div>
                    <p class="text-blue-500 font-bold">Simulación Web</p>
                </div>
            </div>



            <div class="bg-white rounded-md overflow-y-auto h-[calc(100%-2.5rem)]">

                <div>
                    <div class="flex justify-between items-center gap-4">
                        <img src="https://placehold.co/300x60" alt="">
                        <div class="flex gap-4 items-center">
                            <p>Tramites</p>
                            <p>Gobierno</p>
                            <Icon icon="iconoir:search" class="text-3xl" />
                        </div>
                    </div>

                    <div class="flex w-full px-3 bg-[#611232] text-white justify-between items-center">
                        <div class="flex gap-4 items-center">
                            <p v-if="vista === 'inicio'" class="bg-[#ba5462] py-3 px-10">Inicio</p>
                            <p v-else @click="vista = 'inicio'" class="cursor-pointer py-3 px-10">Inicio</p>
                            <p v-if="vista === 'contenido'" class="bg-[#ba5462] py-3 px-10">Tramites y servicios</p>
                            <p v-else @click="vista = 'contenido'" class="cursor-pointer py-3 px-10">Tramites y
                                servicios</p>
                            <p>Personas</p>
                            <p>Empresas</p>
                        </div>
                        <div class="flex gap-2">
                            <img src="https://placehold.co/40x40" alt="">
                            <img src="https://placehold.co/40x40" alt="">
                            <img src="https://placehold.co/100x40" alt="" class="ml-10">
                            <img src="https://placehold.co/100x40" alt="" class="ml-5">
                        </div>
                    </div>
                </div>

                <div v-if="vista === 'inicio'">
                    <div class=" pt-20 pb-10 shadow-lg">
                        <h1 class="text-4xl font-bold text-center">Bienvenid@ al Portal del SAT</h1>
                        <div class="flex gap-10 justify-center items-center mt-10">
                            <!-- Card 1 -->
                            <div
                                class="flex flex-col items-center justify-center bg-white border-2 rounded-lg p-4 w-52">
                                <img src="https://placehold.co/40x40" alt="">
                                <p class="text-center text-2xl font-bold mt-3">Nuevo Contribuyente</p>
                            </div>
                            <div class="border-l-2 h-24 border-[#be955b]"></div>
                            <!-- Botón -->
                            <div @click="vista = 'contenido'"
                                class="border-blue-500 flex flex-col items-center justify-center bg-white border-2 relative rounded-lg p-4 w-52 cursor-pointer hover:scale-105 transition-transform duration-300">
                                <img src="https://placehold.co/40x40" alt="">
                                <p class="text-center text-2xl font-bold mt-3">Continuar al sitio</p>
                                <Icon icon="mdi:hand-pointing-down"
                                    class="text-blue-600 dark:text-slate-50 text-5xl animate-bounce absolute -top-8" />
                            </div>
                        </div>
                        <p class="mt-10 text-center">El Servicio de Administración Tributaria (SAT) recauda con piso
                            parejo,
                            vocación humana y conciencia social para la transformación de México.</p>
                    </div>
                </div>

                <!-- Vista interna -->
                <div v-if="vista === 'contenido'">
                    <img src="https://placehold.co/300x60" alt="" class="w-full h-full object-cover">
                    <div class="p-6 flex items-end px-10 py-10">
                        <h2 class="text-4xl font-bold mr-4 text-gray-600">Trámites y servicios</h2>
                        <hr class="border-t-2 border-gray-600 flex-grow">
                    </div>

                    <!-- Card -->
                    <div class="flex justify-center items-center gap-4 px-32 flex-wrap">
                        <!-- Card 1 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">RFC, personas</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">e.firma, personas</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div @click="vista = 'Declaraciones para personas'"
                            class="w-40 border-2 relative border-blue-500 h-44 cursor-pointer bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <Icon icon="mdi:hand-pointing-down"
                                class="text-blue-600 dark:text-slate-50 text-5xl animate-bounce absolute -top-8" />
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Declaraciones para personas</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 rounded-b-xl flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Cita</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 5 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Factura electrónica</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 6 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">RFC, empresas</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 7 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">e.firma, empresas</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 8 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Declaraciones para empresas</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 9 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Adeudos fiscales</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                        <!-- Card 10 -->
                        <div
                            class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl flex flex-col justify-between items-center text-center group">
                            <!-- Texto -->
                            <div class="p-4">
                                <img src="https://placehold.co/50x50" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Más trámites y servicios</p>
                            </div>
                            <!-- Flecha -->
                            <div
                                class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#611232] transition duration-300">
                                <Icon icon="mdi:arrow-right"
                                    class="text-3xl text-[#C19A5B] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                            </div>
                        </div>
                    </div>

                    <div class="p-6 flex items-end px-10 py-10">
                        <h2 class="text-4xl font-bold mr-4 text-gray-600">Minisitios</h2>
                        <hr class="border-t-2 border-gray-600 flex-grow">
                    </div>

                    <div class="bg-[#f2eada] p-6">
                        <div class="grid grid-cols-4 gap-4 justify-center items-center px-32 flex-wrap">
                            <div
                                class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl justify-between items-center group">
                                <!-- Texto -->
                                <div class="p-4">
                                    <img src="https://placehold.co/50x50" alt="">
                                    <p class="text-green-600 text-lg">Declaración</p>
                                    <p class="font-extrabold text-2xl text-green-800">Cita</p>
                                </div>
                                <!-- Flecha -->
                                <div
                                    class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#008168] transition duration-300">
                                    <Icon icon="mdi:arrow-right"
                                        class="text-3xl text-[#008168] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                                </div>
                            </div>
                            <div
                                class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl justify-between items-center group">
                                <!-- Texto -->
                                <div class="p-4">
                                    <img src="https://placehold.co/50x50" alt="">
                                    <p class="text-green-600 text-sm">Adeudos fiscales</p>
                                    <p class="font-extrabold text-green-800 text-sm">Regularización fiscal</p>
                                </div>
                                <!-- Flecha -->
                                <div
                                    class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#008168] transition duration-300">
                                    <Icon icon="mdi:arrow-right"
                                        class="text-3xl text-[#008168] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                                </div>
                            </div>
                            <div
                                class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl justify-between items-center group">
                                <!-- Texto -->
                                <div class="p-4">
                                    <img src="https://placehold.co/50x50" alt="">
                                    <p class="font-extrabold text-3xl mt-5 text-green-800">Factura</p>
                                </div>
                                <!-- Flecha -->
                                <div
                                    class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#008168] transition duration-300">
                                    <Icon icon="mdi:arrow-right"
                                        class="text-3xl text-[#008168] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                                </div>
                            </div>
                            <div
                                class="w-40 h-44 cursor-pointer overflow-hidden bg-gray-50 rounded-xl shadow-xl justify-between items-center group">
                                <!-- Texto -->
                                <div class="p-4">
                                    <img src="https://placehold.co/50x50" alt="">
                                    <p class="text-green-600 text-lg">Catálogo</p>
                                    <p class="font-extrabold text-2xl text-green-800">Minicitios</p>
                                </div>
                                <!-- Flecha -->
                                <div
                                    class="w-full py-1 px-4 flex justify-end items-center group-hover:bg-[#008168] transition duration-300">
                                    <Icon icon="mdi:arrow-right"
                                        class="text-3xl text-[#008168] group-hover:text-white transform group-hover:-rotate-45 transition-transform duration-300" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="p-6 shadow">
                        <div class="grid grid-cols-4 gap-4 justify-center items-center px-32 flex-wrap">
                            <div
                                class="w-40 border border-gray-200 h-44 cursor-pointer rounded-xl shadow-xl flex items-center justify-center flex-col">
                                <img src="https://placehold.co/80x80" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Declaración anual</p>
                            </div>
                            <div
                                class="w-40 border border-gray-200 h-44 cursor-pointer rounded-xl shadow-xl flex items-center justify-center flex-col">
                                <img src="https://placehold.co/80x80" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Datos abiertos</p>
                            </div>
                            <div
                                class="w-40 border border-gray-200 h-44 cursor-pointer rounded-xl shadow-xl flex items-center justify-center flex-col">
                                <img src="https://placehold.co/80x80" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Anticorrupción</p>
                            </div>
                            <div
                                class="w-40 border border-gray-200 h-44 cursor-pointer rounded-xl shadow-xl flex items-center justify-center flex-col">
                                <img src="https://placehold.co/80x80" alt="">
                                <p class="text-gray-700 font-extrabold text-lg">Normatividad</p>
                            </div>

                        </div>

                    </div>
                </div>

                <div v-if="vista === 'Declaraciones para personas'">
                    <div class="px-10">
                        <div class="flex items-center py-10">
                            <h2 class="text-4xl font-bold mr-4 text-gray-600">Declaraciones y pagos personas físicas
                            </h2>
                            <hr class="border-t-2 border-gray-600 flex-grow">
                        </div>

                        <div class="">
                            <p>Presenta tus declaraciones del impuesto sobre la renta, impuesto al valor agregado e
                                impuesto
                                especial sobre producción y servicios, así como, las declaraciones informativas, que
                                correspondan a tus obligaciones fiscales.</p>
                            <p class="mt-2">Conoce cómo realizar el pago de derechos, productos y aprovechamientos.</p>
                            <p class="mt-2">Ponemos a tu disposición los “Visores”, en los que puedes consultar
                                información
                                sobre comprobantes de nómina, deducciones personales y facturas emitidas o recibidas.
                            </p>
                        </div>

                        <div class="flex items-center py-10">
                            <h2 class="text-3xl font-bold mr-4 text-gray-600">Inicia el trámite</h2>
                            <hr class="border-t-2 border-gray-600 flex-grow">
                        </div>

                        <!-- Tabs -->
                        <div class="">
                            <div class="grid grid-cols-7 gap-2">
                                <div @click="tabs = 'Provisionales y definitivas'"
                                    class="p-2 text-sm border-2 flex items-center justify-center rounded-t-md cursor-pointer relative border-blue-500">
                                    <p class="font-bold text-gray-500 text-center">Provisionales y definitivas</p>
                                    <Icon icon="mdi:hand-pointing-down"
                                        class="text-blue-600 dark:text-slate-50 text-4xl animate-bounce absolute -top-5" />
                                </div>
                                <div @click="tabs = 'Declaraciones de plataformas tecnológicas'"
                                    class="p-2 text-sm border flex items-center justify-center rounded-t-md cursor-pointer">
                                    <p class="font-bold text-gray-500 text-center">Declaraciones de plataformas
                                        tecnológicas
                                    </p>
                                </div>
                                <div @click="tabs = 'Anual'"
                                    class="p-2 text-sm border flex items-center justify-center rounded-t-md cursor-pointer">
                                    <p class="font-bold text-gray-500 text-center">Anual</p>
                                </div>
                                <div @click="tabs = 'Informativas'"
                                    class="p-2 text-sm border flex items-center justify-center rounded-t-md cursor-pointer">
                                    <p class="font-bold text-gray-500 text-center">Informativas</p>
                                </div>
                                <div @click="tabs = 'Visores'"
                                    class="p-2 text-sm border flex items-center justify-center rounded-t-md cursor-pointer">
                                    <p class="font-bold text-gray-500 text-center">Visores</p>
                                </div>
                                <div @click="tabs = 'Derechos, productos y aprovechamientos(DPA)'"
                                    class="p-2 text-sm border flex items-center justify-center rounded-t-md cursor-pointer">
                                    <p class="font-bold text-gray-500 text-center">Derechos, productos y
                                        aprovechamientos(DPA)</p>
                                </div>
                                <div @click="tabs = 'Devoluciones y compensaciones'"
                                    class="p-2 text-sm border flex items-center justify-center rounded-t-md cursor-pointer">
                                    <p class="font-bold text-gray-500 text-center">Devoluciones y compensaciones</p>
                                </div>
                            </div>

                        </div>

                        <!-- View Tabs -->
                        <div v-if="tabs === 'Provisionales y definitivas'">
                            <div class="bg-[#e5e5e5] shadow-inner p-3">
                                <p>Presenta tu declaración de acuerdo al tipo de impuesto y régimen:</p>
                                <!-- Plus 1 -->
                                <div class="flex gap-2 items-center mt-2">
                                    <Icon icon="mdi:plus" class="text-[#be955b] text-4xl cursor-pointer" />
                                    <div>
                                        <ul class="list-disc pl-5 ">
                                            <li class="text-gray-500">ISR e IVA RESICO</li>
                                            <li class="text-gray-500">Retenciones por salarios y asimilados ejercicios
                                                2022
                                                en adelante</li>
                                            <li class="text-gray-500">Actividad empresarial. PODEBI</li>
                                            <li class="text-gray-500">Actividad empresarial y profesional ejercicios
                                                2025 en
                                                adelante</li>
                                            <li class="text-gray-500">Arrendamiento de Inmuebles ejercicios 2025 en
                                                adelante
                                            </li>
                                            <li class="text-gray-500">IVA ejercicios 2025 en adelante</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Plus 2 -->
                                <div class="flex gap-2 items-center mt-2">
                                    <div @click="plus = 2" class="border-2 border-blue-500 rounded-lg relative">
                                        <Icon icon="mdi:plus" class="text-[#be955b] text-4xl cursor-pointer" />
                                        <Icon icon="mdi:hand-pointing-down"
                                            class="text-blue-600 dark:text-slate-50 text-2xl animate-bounce absolute -top-4 right-1" />
                                    </div>
                                    <div>
                                        <ul class="list-disc pl-5 ">
                                            <li class="text-gray-500">Actividad empresarial y servicios profesionales
                                                ejercicios 2024 y anteriores</li>
                                            <li class="text-gray-500">Arrendamiento ejercicios 2024 y anteriores</li>
                                            <li class="text-gray-500">IVA ejercicios 2024 y anteriores</li>
                                            <li class="text-gray-500">IEPS</li>
                                        </ul>
                                    </div>
                                </div>

                                <div v-if="plus === 2">
                                    <div class="flex gap-4 py-5 items-start">
                                        <img src="https://placehold.co/120x120" alt="">

                                        <div class="border-l border-black pl-4">
                                            <p class="font-bold">Requisitos:</p>
                                            <li class="list-disc pl-5 text-gray-500">Contraseña o e.firma</li>
                                            <p class="font-bold">Pasos a seguir:</p>
                                            <ol class="ml-10">
                                                <li class="list-decimal text-gray-500 flex gap-2">Ingresa al
                                                    <button
                                                        class="flex gap-2 items-center border border-blue-500 relative">servicio
                                                        <Icon icon="quill:link-out" />
                                                        <Icon icon="mdi:hand-pointing-down"
                                                            class="text-blue-600 dark:text-slate-50 text-2xl animate-bounce absolute -top-4 right-1" />
                                                    </button>
                                                </li>
                                                <li class="list-decimal text-gray-500">Selecciona el tipo de declaración
                                                    a presentar y llena los datos que te solicita.</li>
                                                <ul>
                                                    <li class="list-disc ml-10 text-gray-500">Actividad empresarial y
                                                        servicios profesionales</li>
                                                    <li class="list-disc ml-10 text-gray-500">Arrendamiento</li>
                                                    <li class="list-disc ml-10 text-gray-500">IVA</li>
                                                    <li class="list-disc ml-10 text-gray-500">IEPS por combustibles
                                                        fósiles</li>
                                                    <li class="list-disc ml-10 text-gray-500">IEPS por combustibles
                                                        automotrices</li>
                                                    <li class="list-disc ml-10 text-gray-500">IEPS por Enajenación de
                                                        gasolinas y diésel</li>
                                                </ul>
                                                <li class="list-decimal text-gray-500">Envía la declaración, guarda el
                                                    acuse de la declaración y, en su caso, línea de captura.</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>


                                <!-- Plus 3 -->
                                <div class="flex gap-2 items-center mt-2">
                                    <Icon icon="mdi:plus" class="text-[#be955b] text-4xl cursor-pointer" />
                                    <div>
                                        <ul class="list-disc pl-5 ">
                                            <li class="text-gray-500">Impuesto especial sobre producción y servicios
                                            </li>
                                            <li class="text-gray-500">Impuesto sobre la renta</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="flex gap-4 mt-10 mb-5 items-center">
                            <Icon icon="material-symbols:arrow-forward-ios-rounded"
                                class="text-3xl text-[#be955b] cursor-pointer" />
                            <p class="text-2xl font-bold text-gray-600">Información adicional</p>
                        </div>
                        <div class="flex gap-4 mt-5 mb-5 items-center">
                            <Icon icon="material-symbols:arrow-forward-ios-rounded"
                                class="text-3xl text-[#be955b] cursor-pointer" />
                            <p class="text-2xl font-bold text-gray-600">Fundamento legal</p>
                        </div>

                        <div class="flex items-center py-10">
                            <h2 class="text-3xl font-bold mr-4 text-gray-600">Material adicional</h2>
                            <hr class="border-t-2 border-gray-600 flex-grow">
                        </div>
                    </div>


                    <div class="bg-[#e6d3bb] p-6">
                        <div class="grid grid-cols-4 gap-4 justify-center items-center px-32 flex-wrap">
                            <div
                                class="w-40 h-44 cursor-pointer rounded-xl border border-transparent hover:border-black">
                                <div class="p-4 flex flex-col items-center justify-center">
                                    <img src="https://placehold.co/80x80" alt="">
                                    <p class="font-bold text-xl text-center text-gray-600">Preguntas frecuentes</p>
                                </div>
                            </div>
                            <div
                                class="w-40 h-44 cursor-pointer rounded-xl border border-transparent hover:border-black">
                                <div class="p-4 flex flex-col items-center justify-center">
                                    <img src="https://placehold.co/80x80" alt="">
                                    <p class="font-bold text-xl text-center text-gray-600">Tutoriales</p>
                                </div>
                            </div>
                            <div
                                class="w-40 h-44 cursor-pointer rounded-xl border border-transparent hover:border-black">
                                <div class="p-4 flex flex-col items-center justify-center">
                                    <img src="https://placehold.co/80x80" alt="">
                                    <p class="font-bold text-xl text-center text-gray-600">Contenidos relacionados</p>
                                </div>
                            </div>
                            <div
                                class="w-40 h-44 cursor-pointer rounded-xl border border-transparent hover:border-black">
                                <div class="p-4 flex flex-col items-center justify-center">
                                    <img src="https://placehold.co/80x80" alt="">
                                    <p class="font-bold text-xl text-center text-gray-600">Documentos relacionados</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- footer -->
                <div class="grid grid-cols-3 gap-4 text-xs mx-14 mt-5">
                    <div class="border-r-2 border-[#be955b]">
                        <p class="text-[#9b2247] font-bold text-xl">Portal de Trámites y Servicios</p>
                        <div class="flex flex-col">
                            <p>Prensa</p>
                            <p>Derechos del Contribuyente</p>
                            <p>Datos abiertos</p>
                            <p>Aviso de privacidad</p>
                            <p>Denuncia a factureras</p>
                            <p>Guía de usuario nuevo Portal</p>
                        </div>
                        <p class="text-[#9b2247] font-bold text-xl">Denuncias SAT</p>
                        <div>
                            <p>denuncias@sat.gob.mx</p>
                            <p>55 8852 2222</p>
                            <p>Nueva denuncia</p>
                        </div>
                    </div>

                    <div class="col-span-2 grid grid-cols-2 gap-2">
                        <div>
                            <p class="text-[#9b2247] font-bold text-xl">Oficinas SAT</p>
                            <div class="flex flex-col">
                                <p>Directorio nacional</p>
                                <p>Atención personal</p>
                                <p>Lunes a Jueves:</p>
                                <p>de 9:00 a 16:00 horas.</p>
                                <p>Viernes:</p>
                                <p>de 8:30 a 15:00 horas.</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-[#9b2247] font-bold text-xl">Contacto </p>
                            <p>Marca SAT 5562722728 De lunes a viernes de 9:00 a 18:00 horas, excepto días
                                inhábiles. Desde cualquier parte del país</p>
                            <div class="mt-10">
                                <p class="text-[#9b2247] font-bold text-xl">Chat uno a uno</p>
                                <div class="flex flex-wrap gap-2 items-center">
                                    <p class="text-[#9b2247] font-bold text-xl">Redes sociales</p>
                                    <img src="https://placehold.co/40x40" alt="">
                                    <img src="https://placehold.co/40x40" alt="">
                                    <img src="https://placehold.co/40x40" alt="">
                                    <img src="https://placehold.co/40x40" alt="">
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="text-[#9b2247] font-bold text-xl">Oficina Central</p>
                            <p>Av. Hidalgo 77, Col. Guerrero, C.P. 06300, Ciudad de México.</p>
                        </div>
                    </div>

                </div>
                <div class="bg-[#611232] mt-3 text-sm">
                    <div>
                        <!-- Loading Cards in a Grid -->
                        <div class="grid grid-cols-4 gap-4 p-6">
                            <div>
                                <img src="https://placehold.co/200x60" alt="">
                            </div>

                            <!--  -->
                            <div>
                                <p class="text-white font-bold text-xl">Enlace</p>
                                <div class="flex flex-col">
                                    <p class="text-white">Datos</p>
                                    <p class="text-white">Publicaciones</p>
                                    <p class="text-white">Portal de Obligaciones de Transparencia</p>
                                    <p class="text-white">INAI</p>
                                    <p class="text-white">Alerta</p>
                                    <p class="text-white">Denuncia</p>
                                </div>
                            </div>

                            <!--  -->
                            <div>
                                <p class="text-white font-bold text-xl">¿Qué es gob.mx?</p>
                                <p class="text-white">Es el portal único de trámites, información y participación
                                    ciudadana. Leer más</p>
                                <p class="text-white">Declaración de Accesibilidad</p>
                                <p class="text-white">Aviso de privacidad</p>
                                <p class="text-white">Aviso de privacidad simplificado</p>
                                <p class="text-white">Términos y condiciones</p>
                                <p class="text-white">Política de seguridad</p>
                                <p class="text-white">Marco jurídico</p>
                                <p class="text-white">Mapa de sitio</p>
                            </div>

                            <!--  -->
                            <div>
                                <p class="text-white font-bold text-xl">Síguenos en</p>
                                <div class="flex gap-2">
                                    <img src="https://placehold.co/40x40" alt="">
                                    <img src="https://placehold.co/40x40" alt="">
                                    <img src="https://placehold.co/40x40" alt="">
                                    <img src="https://placehold.co/40x40" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-[#7a183f] p-6">
                </div>

            </div>


        </section>


    </Main>

</template>

<script setup lang='ts'>
import { ref } from 'vue';
import { Icon } from '@iconify/vue';

import Main from '@/Layouts/Main.vue';

const vista = ref<
    'inicio' |
    'contenido' |
    'Declaraciones para personas'
>('inicio');

const tabs = ref<
    'Provisionales y definitivas' |
    'Declaraciones de plataformas tecnológicas' |
    'Anual' |
    'Informativas' |
    'Visores' |
    'Derechos, productos y aprovechamientos(DPA)' |
    'Devoluciones y compensaciones'
>('Anual');

const plus = ref<number>(0);

</script>

<style></style>