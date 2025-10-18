@extends('layouts.hf')

@section('content')
<div class="mt-12 text-right px-6 md:px-6 lg:px-24 mb-6 mt-6">
    <a href="{{ route('editions.index') }}"
        class="inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white font-semibold rounded-full hover:bg-amber-800 transition">
        ← Volver a ediciones
    </a>
</div>
<section class="bg-white py-16 px-6 md:px-12 lg:px-24">
    <h1 class="text-4xl font-bold text-amber-800 mb-10">{{ $edition->title }}</h1>

    @foreach($sections as $sectionName => $articles)
        <h2 class="text-2xl font-semibold text-amber-700 mt-12 mb-6">{{ $sectionName }}</h2>

        @if($articles->isEmpty())
            <p class="text-neutral-500 italic">No hay artículos para esta sección en esta edición.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($articles as $article)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition group">
                        <a href="{{ route('publications.click', $article->id) }}" target="_blank" class="relative block aspect-[16/10] overflow-hidden">
                            <img src="{{ $article->image_file ? asset('storage/'.$article->image_file) : asset('/img/default.jpg') }}" 
                                alt="{{ $article->title }}" 
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        </a>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-neutral-900">{{ $article->title }}</h3>
                            <p class="text-sm text-neutral-500">{{ $article->author ?? 'Equipo Editorial' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</section>
@endsection
