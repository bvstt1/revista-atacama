@extends('layouts.hf')

@section('content')

<!-- Nosotros -->    
<section class="bg-white text-neutral-900 py-16 px-6 md:px-12 lg:px-24 mt-2">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-3xl md:text-5xl font-serif font-extrabold text-amber-800 drop-shadow-sm">Nosotros</h2>
        <p class="mt-4 mb-10 text-neutral-900 leading-relaxed text-[20px]">
            El equipo de la Revista Digital de Atacama está compuesto por profesionales comprometidos con la investigación,
            la educación y la difusión del patrimonio histórico y cultural de la región.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-center">
            <!-- Director -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border border-neutral-200">
                <h3 class="font-semibold text-amber-800  text-lg">Director</h3>
                <p class="mt-1 font-bold text-amber-700">Guillermo Cortés Lutz</p>
                <p class="mt-1 text-neutral-700 text-[13px]">
                    Profesor de Historia y Geografía
                </p>
                <p class="mt-1 text-neutral-700 text-[13px] font-bold">
                    Doctor en Historia  
                </p>
                <a href="mailto:gea_atacama@yahoo.es" class="mt-2 block text-amber-700  text-[13px] hover:text-amber-300 transition">
                    gea_atacama@yahoo.es
                </a>
            </div>

            <!-- Director -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border border-neutral-200">
                <h3 class="font-semibold text-amber-800  text-lg">Sub Director</h3>
                <p class="mt-1 font-bold text-amber-700">Rodrigo Zalaquett Fuente Alba</p>
                <p class="mt-1 text-neutral-700 text-[13px]">
                    Profesor
                </p>
                <p class="mt-1 text-neutral-700 text-[13px] font-bold">
                    Magister en Historia y Estudios Latinoamericanos 
                </p>
            </div>

            <!-- Editor Área Historia -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border border-neutral-200">
                <h3 class="font-semibold text-amber-800  text-lg">Editor Área Historia</h3>
                <p class="mt-1 font-bold text-amber-700">Francisco Berríos Drolett</p>
                <p class="mt-1 text-neutral-700 text-[13px]">
                    Profesor de Historia y Geografía
                </p>
                <p class="mt-1 text-neutral-700 text-[13px] font-bold">
                    Magíster en Educación Superior
                </p>
            </div>

            <!-- Editor Área Educación -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border border-neutral-200">
                <h3 class="font-semibold text-amber-800  text-lg">Editor Área Educación</h3>
                <p class="mt-1 font-bold text-amber-700">Alex Carvajal Villegas</p>
                <p class="mt-1 text-neutral-700 text-[13px]">
                    Profesor de Biología y Ciencias · Magíster en Educación
                </p>
                <p class="mt-1 text-neutral-700 text-[13px] font-bold">
                    Magíster en Educación
                </p>
            </div>

            <!-- Editor Área Ciencias -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border border-neutral-200">
                <h3 class="font-semibold text-amber-800  text-lg">Editor Área Ciencias</h3>
                <p class="mt-1 font-bold text-amber-700">Yery Marambio</p>
                <p class="mt-1 text-neutral-700 text-[13px]">
                    Ingeniero en Pesca
                </p>
                <p class="mt-1 text-neutral-700 text-[13px] font-bold">
                    Doctor en Ciencias Aplicadas
                </p>
            </div>

            <!-- Informática y Soporte Web -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition border border-neutral-200">
                <h3 class="font-semibold text-amber-800  text-lg">Informática y Soporte Web</h3>
                <p class="mt-1 font-bold text-amber-700">Bastián Velásquez Egaña</p>
            </div>
        </div>
    </div>
</section>

@endsection