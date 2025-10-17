@extends('layouts.hf')

@section('content')
<section class="bg-white text-neutral-900 py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">

        <!-- Botón Volver -->
        <div class="mt-12 flex justify-end">
            <a href="{{ url('/') }}" 
            class="inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white font-semibold rounded-full hover:bg-amber-800 transition">
                ← Volver
            </a>
        </div>

        @foreach ($sections as $section)
            <div class="mb-12 mt-10">
                <h2 class="text-2xl md:text-3xl font-bold text-amber-700 mb-6">{{ $section->title }}</h2>

                @if ($section->items->isEmpty())
                    <p class="text-neutral-500 italic">No hay artículos publicados en esta sección para esta edición.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($section->items as $item)
                            <article class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                                <a href="{{ route('publications.click', $item->id) }}" target="_blank" class="relative block aspect-[16/10] overflow-hidden">
                                    <img src="{{ $item->image_file ? asset('storage/'.$item->image_file) : asset('/img/default.jpg') }}" 
                                        alt="{{ $item->title }}" 
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                                </a>

                                <div class="p-4">
                                    <h3 class="font-serif text-xl font-bold text-neutral-900 group-hover:text-amber-800 transition" title="{{ $item->title }}">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-sm text-neutral-500 mt-1 line-clamp-2">{{ $item->author ?? 'Equipo Editorial' }}</p>
                                    <p class="text-xs text-neutral-400 mt-1">{{ $item->publication_date ? \Carbon\Carbon::parse($item->publication_date)->format('d M Y') : '' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endsection
