@extends('layouts.hf')

@section('content')
<section class="px-6 md:px-12 lg:px-24 py-12 max-w-5xl mx-auto">


    {{-- Título --}}
    <h1 class="text-3xl font-bold text-amber-800 mb-2">
        {{ $efemeride->title }}
    </h1>

    {{-- Año --}}
    <p class="text-sm text-neutral-500 mb-4">
        Año {{ \Carbon\Carbon::parse($efemeride->date)->year }}
    </p>

    {{-- Autor (solo si existe) --}}
    @if($efemeride->author)
        <p class="text-sm italic text-neutral-600 mb-6">
            Por {{ $efemeride->author }}
        </p>
    @endif

    {{-- Descripción --}}
    <div class="prose max-w-none text-neutral-800">
        {!! $efemeride->description !!}
    </div>

    {{-- Volver --}}
    <div class="mt-8">
        <a href="{{ url()->previous() }}"
           class="inline-block px-4 py-2 bg-amber-700 text-white rounded-full hover:bg-amber-800 transition">
            ← Volver
        </a>
    </div>

</section>
@endsection
