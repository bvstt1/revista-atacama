@extends('layouts.hf')

@section('content')
<div class="flex items-center justify-between px-6 md:px-6 lg:px-24 mb-6 mt-6">
    @if(isset($editionDate))
        <div class="text-3xl font-bold text-amber-800">
            <p class="italic">
                @php
                    $date = \Carbon\Carbon::parse($editionDate)->locale('es');
                    $formattedDate = $date->isoFormat('D [de] ') . ucfirst($date->isoFormat('MMMM YYYY'));
                @endphp

                Edición del {{ $formattedDate }}
            </p>
        </div>
    @endif

</div>
<section class="bg-white px-6 md:px-12 lg:px-24">
        @foreach ($sections as $section)
                <h2 class="text-2xl md:text-1xl font-bold text-amber-700 pt-6 mb-6">{{ $section->title }}</h2>

                @if ($section->items->isEmpty())
                    <p class="text-neutral-500 italic">No hay artículos publicados en esta sección para esta edición.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($section->items as $item)
                            <article class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                                <a href="{{ route('publications.click', $item->id) }}" 
                                    target="_blank" 
                                    class="relative block aspect-[16/10] overflow-hidden group">
                                        <img src="{{ $item->image_file ? asset('storage/'.$item->image_file) : asset('/img/default.jpg') }}" 
                                            alt="{{ $item->title }}" 
                                            class="w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                                </a>
                                <div class="p-4">
                                    <h3 class="font-bold text-lg text-neutral-900">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-sm text-neutral-700 font-bold">{{ $item->author ?? 'Equipo Editorial' }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
        @endforeach
</section>
@endsection
