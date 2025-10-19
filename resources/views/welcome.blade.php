@extends('layouts.hf')

@section('content')
    <!-- Carrusel Principal -->
    <section 
        x-data="{
            current: 0, 
            slides: @js($slides),
            interval: null,
            start() { this.interval = setInterval(() => { this.current = (this.current === this.slides.length - 1) ? 0 : this.current + 1 }, 5000) },
            stop() { clearInterval(this.interval); this.interval = null }
        }"
        x-init="start()" @mouseenter="stop()" @mouseleave="start()" 
        class="relative w-full h-[35vh] overflow-hidden group"
        >
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="current === index" x-transition.opacity class="cursor-pointer absolute inset-0" @click="window.location.href = slide.ctaUrl" role="link" :aria-label="slide.title">
                    <img :src="slide.img" :alt="slide.alt" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-8 text-white">
                        <h2 class="text-3xl md:text-5xl font-bold" x-text="slide.title"></h2>
                        <p class="mt-2 text-lg md:text-xl" x-text="slide.description"></p>
                    </div>
                </div>
            </template>
            <!-- Botones -->
            <button @click="current = (current === 0) ? slides.length - 1 : current - 1" class="absolute top-1/2 left-6 -translate-y-1/2 bg-white/50 hover:bg-white/70 text-3xl p-2 rounded-full shadow transition">‹</button>
            <button @click="current = (current === slides.length - 1) ? 0 : current + 1" class="absolute top-1/2 right-6 -translate-y-1/2 bg-white/50 hover:bg-white/70 text-3xl p-2 rounded-full shadow transition">›</button>
            
    </section>

    <!-- Efeméride Crítica Semanal -->
    <section 
        class="mt-10 mb-14 md:mt-14 px-6 md:px-12 lg:px-24"
        x-data="{ 
            efemeride: {
            fecha: '26 de octubre de 1540',
            titulo: 'Acta fundacional de la posesión del Valle de Copiapó',
            resumen: 'En esta fecha, Pedro de Valdivia toma posesión de la zona mediante acta notarial firmada por Luis de Cartagena. Este documento es considerado uno de los hitos fundacionales del territorio atacameño.',
            url: '{{ url("/efemerides/26-10-1540") }}'
            } 
        }"
        >
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 md:p-8 shadow-sm flex flex-col md:flex-row items-start md:items-center gap-6 hover:shadow-md transition">
            
            <!-- Fecha + etiqueta -->
            <div class="shrink-0 text-center md:text-left">
            <span class="inline-block px-3 py-1 text-xs font-semibold bg-amber-700 text-white rounded-full uppercase tracking-wide">
                Efeméride crítica semanal
            </span>
            <p class="mt-3 text-amber-900 font-semibold text-sm" x-text="efemeride.fecha"></p>
            </div>

            <!-- Contenido principal -->
            <div class="flex-1">
            <h3 class="font-serif text-2xl font-bold text-stone-900 leading-snug" x-text="efemeride.titulo"></h3>
            <p class="mt-2 text-stone-700 text-[15px] leading-relaxed" x-text="efemeride.resumen"></p>
            </div>

            <!-- Botón -->
            <div class="self-end md:self-center">
            <a :href="efemeride.url"
                class="inline-block px-5 py-2 bg-amber-700 text-white text-sm font-semibold rounded-full hover:bg-amber-800 transition">
                Ver más
            </a>
            </div>
        </div>
    </section>

    <!-- Índice estilo revista -->
    <section class="bg-white text-neutral-900 py-16 px-6 md:px-12 lg:px-24">
        <div class="max-w-6xl mx-auto grid gap-10 lg:gap-14 md:grid-cols-2">
            <!-- Columna izquierda: Editorial -->
            <article class="space-y-6">
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-amber-800">
                    Editorial: Nacimiento de una Revista Digital
                </h1>

                <div class="flex items-start gap-5">
                    <p class="text-neutral-700 leading-relaxed">
                    A lo largo de la historia de la difusión del conocimiento, como de la reflexión y del pensamiento crítico, han
                    existido en el mundo muchos números uno de distintas revistas. En nuestro caso, la historia de Atacama hunde
                    sus raíces en el lejano periodo de cazadores recolectores, hace unos 11 mil años.
                    </p>
                </div>

                <p class="text-neutral-700 leading-relaxed">
                    Por lo tanto hay mucho que investigar, reflexionar y socializar. Nos introduciremos en los problemas que plantean
                    la ciencia, la política y la educación, generando antecedentes e información bajo miradas críticas y propositivas
                    para la discusión y participación ciudadana.
                </p>

                <p class="text-neutral-700 leading-relaxed">
                    Además, incluiremos recomendaciones y reseñas de libros para orientar aprendizajes analíticos y reflexivos,
                    fomentando el gusto por la lectura.
                </p>

                <p class="italic text-amber-700 font-semibold">— Nombre del editor/a</p>
            </article>

            <!-- Columna derecha: Índice con acordeones -->
            <aside
                x-data="{sections: @js(
                            $sections->map(fn($s)=>[
                                'title' => $s->title,
                                'open' => false,
                                'items' => $s->items->map(fn($it)=>[
                                    'id' => $it->id,            // <- esto es clave
                                    'title' => $it->title,
                                    'author' => $it->author,
                                    'pdf_file' => $it->pdf_file,
                                ])
                            ])
                        )
                    }"
                class="space-y-4"
                >
                <h2 class="text-3xl font-serif font-bold text-amber-800 mb-4">Índice de la Revista: Edición N°1</h2>
                @if(isset($editionDate))
                    <p class="text-sm text-neutral-500">Edición: 
                        {{ \Carbon\Carbon::parse($editionDate)->locale('es')->isoFormat('D [de] MMMM YYYY') }}</p>
                @endif
                <template x-for="(sec, s) in sections" :key="s">
                    <div class="overflow-hidden rounded-lg border border-neutral-200 shadow-sm">
                        <!-- Cabecera -->
                        <button
                            class="w-full flex items-center justify-between bg-neutral-900 text-white px-5 py-4 transition hover:bg-neutral-800"
                            @click="sec.open = !sec.open"
                        >
                            <span class="font-semibold" x-text="sec.title"></span>
                            <div class="flex items-center gap-3">
                            <span class="text-xs bg-white/10 px-2 py-0.5 rounded"
                                    x-text="sec.items.length + ' artículos'"></span>
                            <span class="transition-transform duration-300"
                                    :class="sec.open ? 'rotate-45' : ''">+</span>
                            </div>
                        </button>

                        <!-- Contenido con animación más suave -->
                        <div
                            x-show="sec.open"
                            x-transition:enter="transition-all ease-in-out duration-500"
                            x-transition:enter-start="max-h-0 opacity-0"
                            x-transition:enter-end="max-h-screen opacity-100"
                            x-transition:leave="transition-all ease-in-out duration-400"
                            x-transition:leave-start="max-h-screen opacity-100"
                            x-transition:leave-end="max-h-0 opacity-0"
                            class="overflow-hidden bg-white pointer-events-auto"
                        >
                            <ul class="px-5 py-4 space-y-3">
                                <template x-for="(it, i) in sec.items" :key="i">
                                    <li class="transition-opacity duration-500 ease-in-out">
                                        <!-- Link ajustado para incrementar clicks -->
                                        <a 
                                            :href="`{{ url('/publications') }}/${it.id}/click`"
                                            class="block leading-snug text-[15px] text-neutral-800 hover:text-red-700 underline decoration-red-600 underline-offset-4 cursor-pointer"
                                            target="_blank"
                                        >
                                            <span x-text="it.title"></span>
                                        </a>
                                        <p class="text-sm text-neutral-500" x-text="it.author"></p>
                                        <hr class="mt-3 border-neutral-200" x-show="i !== sec.items.length - 1">
                                    </li>
                                </template>                                
                            </ul>
                        </div>
                    </div>
                </template>
            </aside>
        </div>
    </section>

    <!-- Main Content -->
    <main class="flex-1 p-6 lg:p-8">

        <!-- Artículos destacados -->
        <section x-data="{ 
                    posts: @js($featured),
                    refreshPosts() {
                        fetch('/featured')
                            .then(res => res.json())
                            .then(data => this.posts = data)
                    }
                }"
                x-init="refreshPosts()"
            >
            <div class="flex items-end justify-between mb-6">
                <h2 class="text-3xl font-bold text-amber-800">Artículos destacados de la edición: </h2>
                <a href="{{ url('/articulos') }}" class="text-sm font-semibold text-amber-700 hover:text-amber-900">
                Ver todos →
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <template x-for="(p, i) in posts" :key="i">
                    <article class="group bg-white rounded-xl shadow-sm overflow-hidden ring-1 ring-neutral-200/70 hover:ring-neutral-300 transition">
                        <a :href="p.url" target="_blank" class="relative block aspect-[16/10] overflow-hidden">
                            <img :src="p.img || '/img/default.jpg'" :alt="p.title" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-90"></div>
                        </a>
        
                        <div class="p-4">
                            <a :href="p.url" target="_blank" class="block">
                                <h3 class="font-serif text-xl font-bold leading-tight text-neutral-900 group-hover:text-amber-800 transition" x-text="p.title"></h3>
                                <p class="mt-2 text-neutral-600 line-clamp-2" x-text="p.desc"></p>
                            </a>
        
                            <div class="mt-4 flex items-center justify-between text-sm text-neutral-500">
                                <span>
                                    <span class="font-medium text-neutral-700" x-text="p.author"></span>
    
                                </span>
                                <p x-text="p.date"></p>
                            </div>  
                            <!--
                                <span class="inline-flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6l4 2" />
                                    </svg>
                                    <span x-text="p.clicks"></span>
                            </div>
                            -->
                            
        
                            <div class="mt-4">
                                <a :href="p.url" target="_blank" class="text-amber-700 font-semibold inline-flex items-center gap-1 hover:gap-2 transition-all">
                                    Leer más
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L12 6.414V17a1 1 0 11-2 0V6.414L6.707 9.707A1 1 0 015.293 8.293l5-5z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                </template>
            </div>
        </section>

        <!-- Biblioteca -->
        <section class="mt-16">
            <div class="bg-neutral-900 text-white rounded-md px-4 md:px-6 py-6">
                <!-- Título -->
                <h2 class="inline-flex items-center gap-3 text-xl md:text-2xl font-extrabold tracking-wide uppercase">
                    <span class="h-5 w-1.5 bg-amber-700 rounded-sm"></span>
                    Archivo de Historia de Atacama
                </h2>
                <p class="mt-1 text-white/70">
                    Biblioteca digital de libros y artículos sobre la región.
                </p>

                <!-- Carrusel horizontal -->
                <div class="mt-6 overflow-x-auto no-scrollbar">
                    <ul class="flex gap-6 min-w-max snap-x snap-mandatory">
                        @foreach ($books as $book)
                            <li class="snap-start">
                                <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank" class="group block w-[150px] md:w-[180px]">
                                    <div class="relative rounded-md overflow-hidden shadow-md ring-1 ring-white/5 transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-lg">
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="h-[200px] md:h-[230px] w-full object-cover" />
                                    </div>
                                    <h3 class="mt-2 text-[13px] md:text-sm font-extrabold uppercase leading-snug tracking-wide group-hover:text-amber-700 transition-colors break-words">
                                        {{ $book->title }}
                                    </h3>
                                    <p class="text-[11px] md:text-xs text-white/70 mt-1">
                                        {{ $book->author ?? 'Desconocido' }}
                                        @if($book->publication_date)
                                            ({{ \Carbon\Carbon::parse($book->publication_date)->format('Y') }})
                                        @endif
                                    </p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

    </main>
    
@endsection