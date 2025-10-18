@extends('layouts.hf')

@section('content')
<div class="mt-12 text-right px-6 md:px-6 lg:px-24 mb-6 mt-6">
    <a href="{{ url('/') }}" 
        class="inline-flex items-center gap-2 px-4 py-2 bg-neutral-900 text-white font-semibold rounded-full hover:bg-neutral-800 transition">
        ← Volver al inicio
    </a>
</div>
<section class="bg-white text-neutral-900 py-16 px-6 md:px-12 lg:px-24">
    
    <div class="max-w-6xl mx-auto">

        <!-- Título principal -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-amber-800">
                Ediciones publicadas
            </h1>
            <p class="mt-3 text-neutral-700 max-w-2xl mx-auto">
                Explora las ediciones anteriores de la revista, con los artículos y publicaciones correspondientes a cada fecha.
            </p>
        </div>

        <!-- Contenedor de tarjetas -->
        @if($editions->isEmpty())
            <p class="text-center text-neutral-500">Aún no hay ediciones publicadas.</p>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10 mt-10">
                @foreach ($editions as $edition)
                    <div class="bg-neutral-50 border border-neutral-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col">

                        <!-- Contenido -->
                        <div class="p-5 flex flex-col flex-1">
                            <h2 class="text-xl font-bold text-neutral-900 mb-2">
                                {{ $edition->title }}
                            </h2>
                            <p class="text-sm text-neutral-600 flex-1">
                                {{ Str::limit($edition->description ?? 'Edición correspondiente a las publicaciones de esta fecha.', 100) }}
                            </p>

                            <!-- Botón -->
                            <a href="{{ route('editions.show', $edition->id) }}"
                               class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-700 text-white font-semibold rounded-full hover:bg-amber-800 transition">
                                Ver edición →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif


    </div>
</section>
@endsection
