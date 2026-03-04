@extends('layouts.hf')

@section('content')

<section class="bg-white text-neutral-900 py-16 px-6 md:px-12 lg:px-24 mt-2">
    
    <div class="max-w-6xl mx-auto">

        <!-- Título principal -->
        <div class="text-center">
            <h1 class="text-3xl md:text-5xl font-serif font-extrabold text-amber-800 drop-shadow-sm">
                Ediciones publicadas
            </h1>
            

            <p class="mt-4 text-neutral-600 md:text-lg max-w-3xl mx-auto leading-relaxed">
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
                        <div class="p-5 flex flex-col flex-1 text-center">
                            <h2 class="text-xl font-bold text-neutral-900 mb-2">
                                {{ $edition->title }}
                            </h2

                            <!-- Botón -->
                            <a href="{{ route('editions.show', $edition->id) }}"
                               class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-700 text-white font-semibold rounded-full hover:bg-amber-800 transition">
                                Ver edición
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif


    </div>
</section>
@endsection
