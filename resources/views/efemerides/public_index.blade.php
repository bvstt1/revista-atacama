@extends('layouts.hf')

@section('content')
<div class="mt-12 text-right px-6 lg:px-24 mb-6">
    <a href="{{ url('/') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white font-semibold rounded-full hover:bg-amber-800 transition">
        ← Volver al inicio
    </a>
</div>

<div class="px-6 lg:px-24 mb-6">
    <h1 class="text-3xl font-bold text-amber-800">
        Efemérides de Atacama
    </h1>
</div>

<section class="bg-white px-6 lg:px-24 pb-12">
    <div class="pt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($efemerides as $efemeride)
            <div class="bg-amber-50 rounded-xl shadow-sm p-4 flex flex-col items-center">
                <div class="text-center mb-2">
                    <p class="text-3xl font-bold text-amber-900 leading-none mb-2">
                        @php
                            $date = \Carbon\Carbon::parse($efemeride->date);
                        @endphp

                        {{ $date->format('d') }} de {{ ucfirst($date->translatedFormat('F')) }}
                    </p>
                    <p class="text-xs text-neutral-500">
                        {{ \Carbon\Carbon::parse($efemeride->date)->year }}
                    </p>
                </div>

                <h3 class="font-semibold text-md text-stone-900 text-center mt-2">
                    {{ $efemeride->title }}
                </h3>

                <a href="{{ route('efemerides.show', $efemeride->id) }}"
                   class="font-semibold text-md text-stone-900 text-center mt-2 hover:text-amber-900">
                    Ver más
                </a>
            </div>
        @endforeach

    </div>
</section>
@endsection
