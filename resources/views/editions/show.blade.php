@extends('layouts.hf')

@section('content')
<div class="flex items-center justify-between px-6 md:px-6 lg:px-24 mb-6 mt-6">
    <div class="text-3xl font-bold text-amber-800">
        <p class="italic">
            @php
                $date = \Carbon\Carbon::parse($edition->publication_date)->locale('es');
                $formattedDate = $date->isoFormat('D [de] ') . ucfirst($date->isoFormat('MMMM YYYY'));
            @endphp
            Edición del {{ $formattedDate }}
        </p>
    </div>
</div>
<section class="bg-white px-6 md:px-12 lg:px-24">
    @foreach($sections as $sectionName => $articles)
        <h2 class="text-2xl pt-6 font-bold text-amber-700 mb-6">{{ $sectionName }}</h2>

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
                            <h3 class="font-bold text-lg text-neutral-900">{{ $article->title }}</h3>
                            <p class="text-sm text-neutral-700 font-bold">{{ $article->author ?? 'Equipo Editorial' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</section>
@endsection
