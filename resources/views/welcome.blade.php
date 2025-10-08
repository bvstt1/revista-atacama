<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Revista Historia de Atacama') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="min-h-screen flex flex-col bg-neutral-50 text-neutral-900 roboto-slab">

    <!-- Header -->
    <header class="flex items-center justify-between px-6 py-4 bg-white shadow-md">
    <a href="{{ url('/') }}" class="text-2xl font-bold text-amber-800 font-serif">
        Revista de Historia de Atacama
    </a>

    <!-- Navegación principal -->
    <nav class="hidden md:flex space-x-6 text-stone-700 font-medium">
        <a href="{{ url('/editorial') }}" class="hover:text-amber-700">Editorial</a>
        <a href="{{ url('/normas') }}" class="hover:text-amber-700">Normas Editoriales</a>
        <a href="{{ url('/ediciones') }}" class="hover:text-amber-700">Ediciones Publicadas</a>
        <a href="{{ url('/nosotros') }}" class="hover:text-amber-700">Nosotros</a>
        <a href="{{ url('/contacto') }}" class="hover:text-amber-700">Contacto</a>
    </nav>

    <!-- Botón destacado -->
    <a href="{{ url('/efemerides') }}"
        class="hidden md:block ml-6 px-4 py-2 bg-amber-700 text-white rounded-full hover:bg-amber-800 transition-colors">
        Efemérides
    </a>

    <!-- Botón menú móvil -->
    <button class="md:hidden text-2xl text-amber-800" id="mobile-menu-button">☰</button>
    </header>

    <!-- Menú móvil -->
    <div class="md:hidden hidden flex-col space-y-2 bg-white px-6 py-4 shadow-md" id="mobile-menu">
    <a href="{{ url('/') }}" class="block py-2 text-stone-700 hover:text-amber-700">Inicio</a>
    <a href="{{ url('/editorial') }}" class="block py-2 text-stone-700 hover:text-amber-700">Editorial</a>
    <a href="{{ url('/normas') }}" class="block py-2 text-stone-700 hover:text-amber-700">Normas Editoriales</a>
    <a href="{{ url('/ediciones') }}" class="block py-2 text-stone-700 hover:text-amber-700">Ediciones Publicadas</a>
    <a href="{{ url('/nosotros') }}" class="block py-2 text-stone-700 hover:text-amber-700">Nosotros</a>
    <a href="{{ url('/contacto') }}" class="block py-2 text-stone-700 hover:text-amber-700">Contacto</a>
    <a href="{{ url('/efemerides') }}" class="block py-2 text-amber-700 font-semibold">Efemérides</a>
    </div>
    
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
        <!-- Columna derecha: Índice con animación suave -->
        <aside
        x-data="{
            sections: @js(
            $sections->map(fn($s)=>[
                'title'=>$s->title,
                'open'=>false,
                'items'=>$s->items->map(fn($it)=>[
                'title'=>$it->title,
                'author'=>$it->author,
                'url'=>$it->url,
                ])
            ])
            )
        }"
        class="space-y-4"
        >
        <h2 class="text-3xl font-serif font-bold text-amber-800 mb-4">Índice de la Revista: Edición N°1</h2>
        <p class="">26 de octubre de 2025</p>
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
                class="overflow-hidden bg-white"
            >
                <ul class="px-5 py-4 space-y-3">
                <template x-for="(it, i) in sec.items" :key="i">
                    <li class="group transition-opacity duration-500 ease-in-out">
                    <a :href="it.url"
                        class="block leading-snug text-[15px] text-neutral-800 hover:text-red-700 underline decoration-red-600 underline-offset-4 group-hover:decoration-2">
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
    <section class="mt-12" 
            x-data="{
            posts: [
            {
                title: 'El poblamiento temprano del Desierto de Atacama',
                desc: 'Evidencias arqueológicas y rutas de movilidad en ambientes hiperáridos.',
                img: 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?q=80&w=1600&auto=format&fit=crop',
                url: '{{ url("/historia/poblamiento-temprano") }}',
                author: 'Equipo Editorial',
                date: 'Mar 2025',
                read: '6 min'
            },
            {
                title: 'Educación y patrimonio: aprender con el territorio',
                desc: 'Prácticas pedagógicas para resignificar memoria y cultura regional.',
                img: 'https://images.unsplash.com/photo-1600550379229-42a1b6f3b43b?q=80&w=1600&auto=format&fit=crop',
                url: '{{ url("/educacion/patrimonio-aprender") }}',
                author: 'M. Rojas',
                date: 'Feb 2025',
                read: '5 min'
            },
            {
                title: 'Minería, agua y comunidad: tensiones del presente',
                desc: 'Un análisis sobre gestión hídrica y participación ciudadana en Atacama.',
                img: 'https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1600&auto=format&fit=crop',
                url: '{{ url("/politica/mineria-agua-comunidad") }}',
                author: 'C. Herrera',
                date: 'Ene 2025',
                read: '7 min'
            }
            ]
            }">
    <div class="flex items-end justify-between mb-6">
        <h2 class="text-3xl font-bold text-amber-800">Artículos destacados</h2>
        <a href="{{ url('/ediciones') }}" class="text-sm font-semibold text-amber-700 hover:text-amber-900">
        Ver todos →
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <template x-for="(p, i) in posts" :key="i">
        <article class="group bg-white rounded-xl shadow-sm overflow-hidden ring-1 ring-neutral-200/70 hover:ring-neutral-300 transition">
            <!-- Imagen con overlay y zoom -->
            <a :href="p.url" class="relative block aspect-[16/10] overflow-hidden">
            <img :src="p.img" :alt="p.title" 
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-90"></div>
            </a>

            <!-- Texto -->
            <div class="p-4">
            <a :href="p.url" class="block">
                <h3 class="font-serif text-xl font-bold leading-tight text-neutral-900 group-hover:text-amber-800 transition"
                    x-text="p.title"></h3>
                <p class="mt-2 text-neutral-600 line-clamp-2" x-text="p.desc"></p>
            </a>

            <!-- Meta -->
            <div class="mt-4 flex items-center justify-between text-sm text-neutral-500">
                <span>
                <span class="font-medium text-neutral-700" x-text="p.author"></span>
                · <span x-text="p.date"></span>
                </span>
                <span class="inline-flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6l4 2" />
                </svg>
                <span x-text="p.read"></span>
                </span>
            </div>

            <!-- CTA -->
            <div class="mt-4">
                <a :href="p.url" class="text-amber-700 font-semibold inline-flex items-center gap-1 hover:gap-2 transition-all">
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


        <!-- Secciones por Categoría -->
        <section class="mt-16">
        <div
            class="bg-neutral-900 text-white rounded-md px-4 md:px-6 py-6"
            x-data="{
            items: [
                { title: 'Archivo: Informe del Desierto (1898)', cover: 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?w=800&q=80', url: '#' },
                { title: 'Memorias de la Minería Salitrera', cover: 'https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800&q=80', url: '#' },
                { title: 'Censos y Padrones (1875–1920)', cover: 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=800&q=80', url: '#' },
                { title: 'Cartografía Histórica de Atacama', cover: 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800&q=80', url: '#' },
                { title: 'Fotografía Patrimonial de Pueblos de Indios', cover: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&q=80', url: '#' },
                { title: 'Revistas Regionales 1900–1950', cover: 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=800&q=80', url: '#' },
                { title: 'Colección de Oralidades Atacameñas', cover: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=800&q=80', url: '#' },
                { title: 'Actas Municipales Digitalizadas', cover: 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=800&q=80', url: '#' }
            ]
            }"
        >
            <!-- Título -->
            <h2 class="inline-flex items-center gap-3 text-xl md:text-2xl font-extrabold tracking-wide uppercase">
            <span class="h-5 w-1.5 bg-amber-700 rounded-sm"></span>
            Archivo de Historia de Atacama
            </h2>
            <p class="mt-1 text-white/70">Biblioteca digital de libros y artículos sobre la región.</p>

            <!-- Carrusel horizontal -->
            <div class="mt-6 overflow-x-auto no-scrollbar">
            <ul class="flex gap-6 min-w-max snap-x snap-mandatory">
                <template x-for="(it, i) in items" :key="i">
                <li class="snap-start">
                    <a :href="it.url" class="group block w-[150px] md:w-[180px]">
                    <div class="relative rounded-md overflow-hidden shadow-md ring-1 ring-white/5 transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-lg">
                        <img :src="it.cover" alt="" class="h-[200px] md:h-[230px] w-full object-cover" />
                    </div>
                    <h3 class="mt-4 text-[13px] md:text-sm font-extrabold uppercase leading-tight tracking-wide line-clamp-2 group-hover:text-amber-700 transition-colors">
                        <span x-text="it.title"></span>
                    </h3>
                    </a>
                </li>
                </template>
            </ul>
            </div>
        </div>
    </section>

    <!-- Resúmenes de tesis de Magíster -->
    <!-- 
    <section class="mt-12"
    x-data="{
        theses: [
        {
            title: 'Memoria y escuela en el Valle de Copiapó (1990–2010)',
            abstract: 'Análisis de prácticas pedagógicas para la transmisión de memoria local en establecimientos públicos.',
            img: 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?q=80&w=1600&auto=format&fit=crop',
            url: '{{ url("/educacion/tesis/memoria-escuela-copiapo") }}',
            author: 'María Rojas',
            program: 'Magíster en Educación',
            university: 'Universidad de Atacama',
            year: '2024',
            read: '7 min'
        },
        {
            title: 'Patrimonio minero y ciudadanía en Atacama',
            abstract: 'Estrategias de educación patrimonial para fortalecer identidad y participación.',
            img: 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1600&auto=format&fit=crop',
            url: '{{ url("/educacion/tesis/patrimonio-minero-ciudadania") }}',
            author: 'Gonzalo Álvarez',
            program: 'Magíster en Educación',
            university: 'Universidad de Chile',
            year: '2023',
            read: '6 min'
        },
        {
            title: 'Aprendizaje basado en territorio en liceos técnicos',
            abstract: 'Diseño e implementación de secuencias didácticas con enfoque territorial.',
            img: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1600&auto=format&fit=crop',
            url: '{{ url("/educacion/tesis/aprendizaje-territorial-lictec") }}',
            author: 'Valeria Fuentelba',
            program: 'Magíster en Educación',
            university: 'PUC',
            year: '2025',
            read: '5 min'
        }
        ]
    }"
    >
    <div class="flex items-end justify-between mb-6">
        <h2 class="text-3xl font-bold text-amber-800">Resúmenes de tesis (Magíster)</h2>
        <a href="{{ url('/educacion/tesis') }}" class="text-sm font-semibold text-amber-700 hover:text-amber-900">
        Ver todas →
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <template x-for="(t, i) in theses" :key="i">
        <article class="group bg-white rounded-xl shadow-sm overflow-hidden ring-1 ring-neutral-200/70 hover:ring-neutral-300 transition">
            <a :href="t.url" class="relative block aspect-[16/10] overflow-hidden">
            <img :src="t.img" :alt="t.title" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
            <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-700 text-white">
                Resumen de tesis
            </span>
            </a>
            <div class="p-4">
            <a :href="t.url" class="block">
                <h3 class="font-serif text-xl font-bold leading-tight text-neutral-900 group-hover:text-amber-800 transition" x-text="t.title"></h3>
                <p class="mt-2 text-neutral-600 line-clamp-2" x-text="t.abstract"></p>
            </a>
            <div class="mt-3 text-sm text-neutral-500">
                <span class="font-medium text-neutral-700" x-text="t.author"></span>
                · <span x-text="t.program"></span>
                · <span x-text="t.university"></span>
                · <span x-text="t.year"></span>
            </div>
            <div class="mt-4">
                <a :href="t.url" class="text-amber-700 font-semibold inline-flex items-center gap-1 hover:gap-2 transition-all">
                Leer resumen
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
    -->

    <!-- Reseñas de libros -->
    <section class="mt-16 px-6 md:px-12 lg:px-24"
    x-data="{
        current: 0,
        reviews: @js($reviews),
        next(){ this.current = (this.current + 1) % this.reviews.length },
        prev(){ this.current = (this.current - 1 + this.reviews.length) % this.reviews.length }
    }"
    > 
    <div class="flex items-end justify-between mb-6">
        <h2 class="text-3xl font-bold text-amber-800">Reseñas de libros</h2>
        <a href="{{ url('/resenas') }}" class="text-sm font-semibold text-amber-700 hover:text-amber-900">Ver todas →</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- DESTACADA -->
        <article class="lg:col-span-2 relative overflow-hidden rounded-2xl ring-1 ring-neutral-200 bg-gradient-to-br from-amber-50 to-white">
        <div class="relative aspect-[16/9]">
            <template x-for="(r, i) in reviews" :key="i">
            <img x-show="current === i"
                x-transition.opacity
                :src="r.img" :alt="r.bookTitle" loading="lazy"
                class="absolute inset-0 w-full h-full object-cover">
            </template>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/25 to-transparent"></div>

            <!-- Contenido sobre imagen -->
            <div class="absolute inset-x-0 bottom-0 p-6 md:p-8 text-white z-20">
            <template x-for="(r, i) in reviews" :key="'txt-'+i">
                <div x-show="current === i" x-transition.opacity>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-700">Reseña</span>
                <h3 class="mt-3 font-serif text-2xl md:text-3xl font-bold leading-tight" x-text="r.bookTitle"></h3>
                <p class="mt-2 text-white/90 line-clamp-2 md:line-clamp-3" x-text="r.desc"></p>
                <div class="mt-3 text-sm text-white/80">
                    <span class="font-medium" x-text="r.author"></span> · <span x-text="r.date"></span> · <span x-text="r.read"></span>
                </div>
                <div class="mt-4">
                    <a :href="r.url" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur px-4 py-2 rounded-full text-sm font-semibold transition">
                    Leer reseña
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L12 6.414V17a1 1 0 11-2 0V6.414L6.707 9.707A1 1 0 015.293 8.293l5-5z"/>
                    </svg>
                    </a>
                </div>
                </div>
            </template>
            </div>

            <!-- Controles -->
            <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-3 pointer-events-none">
            <button type="button" @click="prev()" aria-label="Reseña anterior"
                    class="grid place-items-center w-9 h-9 rounded-full bg-black/35 hover:bg-black/50 text-white transition pointer-events-auto">‹</button>
            <button type="button" @click="next()" aria-label="Reseña siguiente"
                    class="grid place-items-center w-9 h-9 rounded-full bg-black/35 hover:bg-black/50 text-white transition pointer-events-auto">›</button>
            </div>
        </div>
        </article>

        <!-- LISTA LATERAL (clicable) -->
        <aside class="bg-white rounded-2xl ring-1 ring-neutral-200 p-3 md:p-4">
        <ul class="flex flex-col divide-y divide-neutral-200">
            <template x-for="(r, i) in reviews" :key="'mini-'+i">
            <li>
                <button type="button" @click="current = i"
                        class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-amber-50 transition text-left"
                        :class="current === i ? 'bg-amber-50 ring-1 ring-amber-200' : ''">
                <img :src="r.img" :alt="r.title" loading="lazy"
                    class="w-14 h-14 rounded-md object-cover ring-1 ring-neutral-200">
                <div class="min-w-0">
                    <h4 class="font-medium text-[15px] text-neutral-900 line-clamp-1" x-text="r.title"></h4>
                    <p class="text-sm text-neutral-500 line-clamp-1" x-text="r.desc"></p>
                </div>
                </button>
            </li>
            </template>
        </ul>
        </aside>
    </div>
    </section>


    </main>

    <!-- Footer -->
    <footer class="bg-stone-950 text-stone-200 mt-16">
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-10 border-t border-stone-800">

        <!-- Columna 1: Identidad -->
        <div>
        <h3 class="text-xl font-bold text-amber-600 mb-3 font-serif">Revista de Historia de Atacama</h3>
        <p class="text-sm text-stone-400 leading-relaxed">
            Publicación digital dedicada a la investigación, educación y divulgación del patrimonio histórico,
            social y cultural de la Región de Atacama.
        </p>
        <p class="mt-4 text-sm text-stone-500">ISSN 2957-0821</p>
        <p class="text-sm text-stone-500">Copiapó — Región de Atacama, Chile</p>
        </div>

        <!-- Columna 2: Equipo editorial -->
        <div>
        <h4 class="text-sm font-semibold uppercase tracking-wider text-stone-400 mb-3">Equipo Editorial</h4>
        <ul class="text-sm text-stone-300 space-y-3 leading-relaxed">

            <li>
            <span class="block font-semibold text-amber-500">Director:</span>
            <span class="block">Guillermo Cortés Lutz</span>
            <span class="block text-stone-400 text-[13px]">
                Profesor de Historia y Geografía · Doctor en Historia
            </span>
            <a href="mailto:gea_atacama@yahoo.es" class="block text-[13px] text-amber-500 hover:text-amber-400 transition">
                gea_atacama@yahoo.es
            </a>
            </li>

            <li>
            <span class="block font-semibold text-amber-500">Editor Área Historia:</span>
            <span class="block">Francisco Berríos Drolett</span>
            <span class="block text-stone-400 text-[13px]">
                Profesor de Historia y Geografía · Magíster en Educación Superior
            </span>
            </li>

            <li>
            <span class="block font-semibold text-amber-500">Editor Área Educación:</span>
            <span class="block">Alex Carvajal Villegas</span>
            <span class="block text-stone-400 text-[13px]">
                Profesor de Biología y Ciencias · Magíster en Educación
            </span>
            </li>

            <li>
            <span class="block font-semibold text-amber-500">Editor Área Ciencias:</span>
            <span class="block">Yery Marambio</span>
            <span class="block text-stone-400 text-[13px]">
                Ingeniero en Pesca · Doctor en Ciencias Aplicadas
            </span>
            </li>

            <li>
            <span class="block font-semibold text-amber-500">Informática y Soporte Web:</span>
            <span class="block">Bastián Velásquez</span>
            </li>

            <li>
            <span class="block font-semibold text-amber-500">Correo Editorial:</span>
            <a href="mailto:revista@historiaatacama.cl" class="block text-[13px] text-amber-500 hover:text-amber-400 transition">
                revista@historiaatacama.cl
            </a>
            </li>

        </ul>
        </div>


        <!-- Columna 3: Información editorial -->
        <div>
        <h4 class="text-sm font-semibold uppercase tracking-wider text-stone-400 mb-3">Información</h4>
        <ul class="space-y-2 text-sm">
            <li><a href="{{ url('/editorial') }}" class="hover:text-amber-500 transition">Editorial</a></li>
            <li><a href="{{ url('/normas') }}" class="hover:text-amber-500 transition">Normas Editoriales</a></li>
            <li><a href="{{ url('/ediciones') }}" class="hover:text-amber-500 transition">Ediciones Publicadas</a></li>
            <li><a href="{{ url('/archivo') }}" class="hover:text-amber-500 transition">Archivo de Historia de Atacama</a></li>
            <li><a href="{{ url('/efemerides') }}" class="hover:text-amber-500 transition">Efemérides</a></li>
            <li><a href="{{ url('/contacto') }}" class="hover:text-amber-500 transition">Contacto</a></li>
        </ul>
        </div>

        <!-- Columna 4: Redes y créditos -->
        <div>
        <h4 class="text-sm font-semibold uppercase tracking-wider text-stone-400 mb-3">Conecta con nosotros</h4>
        <div class="flex space-x-4 text-lg mb-5">
            <a href="#" aria-label="Facebook" class="hover:text-amber-500 transition"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" aria-label="Twitter" class="hover:text-amber-500 transition"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" aria-label="Instagram" class="hover:text-amber-500 transition"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" aria-label="YouTube" class="hover:text-amber-500 transition"><i class="fa-brands fa-youtube"></i></a>
        </div>

        <p class="text-xs text-stone-500 leading-relaxed">
            Desarrollado por el equipo de la <span class="text-amber-600">Revista de Historia de Atacama</span>.<br>
            Plataforma digital creada en Laravel · {{ date('Y') }}
        </p>
        </div>
    </div>

    <!-- Línea inferior -->
    <div class="border-t border-stone-800 text-center py-4 text-xs text-stone-500">
        &copy; {{ date('Y') }} Revista de Historia de Atacama — Todos los derechos reservados.
    </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>
</html>
