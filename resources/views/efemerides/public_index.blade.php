@extends('layouts.hf')

@section('content')
    <section class="bg-white text-neutral-900 py-16 px-6 md:px-12 lg:px-24 mt-2">
        <div class="max-w-6xl mx-auto">
            <div class="text-center">
                <h1 class="text-3xl md:text-5xl font-serif font-extrabold text-amber-800 drop-shadow-sm">
                    Efemérides de la Región de Atacama
                </h1>


                <p class="mt-4 text-neutral-600 md:text-lg max-w-3xl mx-auto leading-relaxed">
                    Conoce de las efemérides históricas más relevantes de la región de Atacama, con eventos que marcaron
                    hitos importantes en su historia.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10 mt-10">
                @foreach ($efemerides as $efemeride)
                    <div
                        class="bg-neutral-50 border border-neutral-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col">
                        <div class="p-5 flex flex-col flex-1 text-center">
                            <p class="text-2xl font-bold text-neutral-900 mb-2">
                                @php
                                    $date = \Carbon\Carbon::parse($efemeride->date);
                                @endphp

                                {{ $date->format('d') }} de {{ ucfirst($date->translatedFormat('F')) }}
                            </p>
                            <p class="text-xs text-neutral-600 font-bold">
                                {{ \Carbon\Carbon::parse($efemeride->date)->year }}
                            </p>

                            <h3 class="font-semibold text-md text-stone-900 text-center mt-2">
                                {{ $efemeride->title }}
                            </h3>

                            <a href="{{ route('efemerides.show', $efemeride->id) }}"
                                class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-700 text-white font-semibold rounded-full hover:bg-amber-800 transition">
                                Ver más
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
