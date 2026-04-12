@extends('layouts.hf')

@section('content')
    <!-- Carrusel Principal -->
    <section x-data="{
        current: 0,
        slides: [{
                img: '/img/slides/slide1.jpg',
                alt: 'Historia Viva de Atacama',
                title: 'Historia Viva de Atacama',
                description: 'Procesos, pueblos y memorias que forjaron la identidad del desierto.'
            },
            {
                img: '/img/slides/slide2.jpg',
                alt: 'Educación y Cultura',
                title: 'Educación y Patrimonio',
                description: 'Prácticas educativas que preservan memoria y cultura regional.'
            },
            {
                img: '/img/slides/slide3.jpg',
                alt: 'Descripción de la imagen 3',
                title: 'Politica y Sociedad',
                description: 'Análisis crítico de la evolución sociopolítica en Atacama, Chile y el mundo.'
            }
        ],
        interval: null,
        start() {
            this.interval = setInterval(() => {
                this.current = (this.current === this.slides.length - 1) ? 0 : this.current + 1
            }, 5000)
        },
        stop() {
            clearInterval(this.interval);
            this.interval = null
        }
    }" x-init="start()" @mouseenter="stop()" @mouseleave="start()"
        class="relative w-full h-[40vh] md:h-[50vh]">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="current === index" x-transition.opacity class="absolute inset-0">
                <img :src="slide.img" :alt="slide.alt" class="w-full h-full object-cover" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-8 text-white">
                    <h2 class="text-2xl md:text-5xl font-bold" x-text="slide.title"></h2>
                    <p class="mt-2 text-base md:text-xl" x-text="slide.description"></p>
                </div>
            </div>
        </template>

        <!-- Botones -->
        <button @click="current = (current === 0) ? slides.length - 1 : current - 1"
            class="absolute top-1/2 left-6 -translate-y-1/2 bg-white/50 hover:bg-white/70 text-3xl p-2 rounded-full shadow transition">
            ‹
        </button>
        <button @click="current = (current === slides.length - 1) ? 0 : current + 1"
            class="absolute top-1/2 right-6 -translate-y-1/2 bg-white/50 hover:bg-white/70 text-3xl p-2 rounded-full shadow transition">
            ›
        </button>
    </section>


    <!-- Efeméride Crítica Semanal -->
    <section class="mt-14 mb-14 md:mt-14 px-6 md:px-12 lg:px-24" x-data="{
        efemeride: @js($efemeride),
        open: false
    }">
        <div
            class="bg-amber-50 border border-amber-200 rounded-xl p-6 md:p-8 shadow-sm flex flex-col md:flex-row items-start md:items-center gap-6 hover:shadow-md transition">
            <div class="flex-1">
                <!-- Fecha + etiqueta -->
                <div class="mb-6 flex flex-wrap justify-center sm:justify-start items-center gap-3">

                    <!-- Sello editorial -->
                    <span
                        class="inline-flex items-center justify-center px-4 py-1.5 text-sm md:text-base font-semibold 
                                bg-amber-700 text-white rounded-full tracking-wide shadow-sm w-full sm:w-auto">
                        Efeméride crítica semanal
                    </span>

                    <!-- Fecha -->
                    <span
                        class="inline-flex items-center px-3 py-1 text-sm font-semibold 
                                bg-amber-100 text-amber-800 rounded-lg border border-amber-200">
                        <span class="text-lg md:text-xl font-bold"
                            x-text="(() => {
                                const [y, m, d] = efemeride.date.split('-');
                                const date = new Date(y, m - 1, d);
                                const day = date.getDate();
                                const month = date.toLocaleString('es-ES', { month: 'long' });
                                return `${day} de ${month.charAt(0).toUpperCase() + month.slice(1)}`;
                            })()">
                        </span>
                    </span>

                </div>
                <!-- Título -->
                <h3 class="font-serif text-3xl font-bold text-stone-900 leading-snug">
                    <span x-text="efemeride.title"></span>
                </h3>

                <!-- Contenido con CKEditor -->
                <div class="relative mt-3">
                    <div class="prose prose-stone max-w-none transition-all duration-500 overflow-hidden"
                        :class="open ? 'max-h-[5000px]' : 'max-h-40'" x-html="efemeride.description">
                    </div>

                    <!-- Degradado inferior -->
                    <div x-show="!open"
                        class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-amber-50 to-transparent pointer-events-none">
                    </div>
                </div>

                <!-- Botón -->
                <button @click="open = !open" class="mt-4 text-amber-700 font-semibold hover:underline focus:outline-none"
                    x-text="open ? 'Leer menos' : 'Leer más'">
                </button>

            </div>
        </div>
    </section>


    <!-- Índice estilo revista -->
    <section class="bg-white text-neutral-900 py-20 px-6 md:px-12 lg:px-24">
        <div class="max-w-7xl mx-auto grid gap-16 lg:grid-cols-2 items-start">

            <!--COLUMNA IZQUIERDA: EDITORIAL -->
            <article class="space-y-6 leading-relaxed">

                <!-- Título -->
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-amber-800 border-l-8 border-amber-600 pl-4">
                    Editorial: Revista N° 3 – Historia de Atacama.
                </h1>

                <!-- Contenido -->
                <div class="prose prose-neutral max-w-none text-justify">
                    <p>
                        La importancia del Museo Regional de Atacama radica en su consolidación como pilar fundamental para
                        el estudio de la historia y el patrimonio de nuestra región. No se trata únicamente de un edificio
                        que resguarda objetos: es, ante todo, un laboratorio vivo de la memoria histórica atacameña, un
                        espacio donde el pasado dialoga con el presente y proyecta el futuro.<br>
                    </p>
                    <p></p>
                    <br>
                    El nuevo museo trasciende lo arquitectónico para posicionarse como un motor de desarrollo integral. En
                    él convergen identidad, investigación y comunidad. Su existencia impulsa el rescate y la valoración del
                    patrimonio cultural, fortaleciendo la conciencia regional y el sentido de pertenencia.<br>
                    </p>
                    <br>
                    <p>
                        Esta edición nos permite recorrer la cronología crítica de su gestación: desde el año 2007, cuando
                        comenzó la búsqueda de un espacio que acogiera a la comunidad en torno a su patrimonio, hasta marzo
                        de 2026, momento en que aquel anhelo histórico comenzó a materializarse. Detrás de cada etapa hay
                        voluntades, debates, esfuerzos técnicos y convicciones profundas sobre la necesidad de un museo a la
                        altura de la historia de Atacama.<br>
                    </p>
                    <br>
                    <p>
                        En sus salas, los especialistas plasman su conocimiento a través del guion museográfico,
                        transformando la investigación académica en relato accesible, pedagógico y significativo. Porque la
                        ciencia —hija de la curiosidad humana— encuentra en el museo uno de sus espacios más nobles de
                        difusión. Allí se publica y se socializa el saber científico vinculado a los estudios patrimoniales
                        de nuestra región.<br>
                    </p>
                    <br>
                    <p>
                        Este número amplía la mirada. Nos invita a reflexionar sobre los primeros indicios de vida
                        comunitaria organizada y el surgimiento de estructuras sociales complejas, recordándonos que la
                        historia de la humanidad es también la historia de la cooperación y la construcción colectiva.<br>
                    </p>
                    <br>
                    <p>
                        Desde la ciencia natural, se presenta un estudio sobre recientes observaciones del comportamiento
                        reproductivo de Liolaemus fabiani, con ejemplares observados tanto en su medio natural como en
                        cautiverio, aportando valiosa información al conocimiento de la herpetología atacameña y a la
                        conservación de su biodiversidad.<br>
                    </p>
                    <br>
                    <p>
                        Finalmente, revisitamos la figura de Pedro León Gallo, destacando la vigencia de su pensamiento y la
                        trascendencia de su lucha por la región. Su legado continúa dialogando con las nuevas generaciones,
                        recordándonos que la historia regional está hecha de ideas, convicciones y compromiso.<br>
                    </p>
                    <br>
                    <p>
                        Así, este tercer número reafirma nuestra convicción: la historia no es únicamente memoria; es
                        conciencia, identidad y responsabilidad. Y el Museo Regional de Atacama se erige como uno de los
                        espacios más significativos donde esa conciencia se cultiva y se proyecta.<br>
                    </p>
                </div>

                <!-- Firma -->
                <div class="pt-6 border-t border-neutral-200">
                    <p class="italic text-amber-700 font-bold">Con estima y compromiso histórico</p>
                    <p class="italic text-amber-700 font-bold mt-4">Francisco Berrios Drolett</p>
                    <p class="italic font-bold text-neutral-900">Profesor de Historia y Geografía</p>
                    <p class="italic font-bold text-neutral-900">Magister en Educación Superior</p>
                    <p class="italic font-bold text-neutral-900">Editor Histórico RHA</p>
                </div>
            </article>

            <!-- 📚 COLUMNA DERECHA: ÍNDICE -->
            <aside x-data="{ sections: @js(
    $sections->map(
        fn($s) => [
            'title' => $s->title,
            'open' => false,
            'items' => $s->items->map(
                fn($it) => [
                    'id' => $it->id,
                    'title' => $it->title,
                    'author' => $it->author,
                    'pdf_file' => $it->pdf_file,
                ],
            ),
        ],
    ),
) }"
                class="bg-neutral-50 border border-neutral-200 rounded-2xl shadow-md p-6 sticky top-24">
                <h2 class="text-3xl font-serif font-bold text-amber-800 mb-2">Índice de la Revista</h2>

                @if (isset($editionDate))
                    <p class="text-sm text-neutral-500 mb-6">
                        Edición N°3 — {{ \Carbon\Carbon::parse($editionDate)->locale('es')->isoFormat('D [de] MMMM YYYY') }}
                    </p>
                @endif

                <!-- Acordeones -->
                <div class="space-y-4">
                    <template x-for="(sec, s) in sections" :key="s">
                        <div class="border border-neutral-200 rounded-lg overflow-hidden shadow-sm">
                            <!-- Cabecera -->
                            <button
                                class="w-full flex items-center justify-between bg-neutral-900 text-white px-5 py-4 text-left transition hover:bg-neutral-800"
                                @click="sec.open = !sec.open">
                                <span class="font-semibold" x-text="sec.title"></span>
                                <div class="flex items-center gap-3">
                                    <span class="hidden sm:inline-flex text-xs bg-white/10 px-2 py-0.5 rounded"
                                        x-text="sec.items.length + ' artículos'"></span>
                                    <span class="transition-transform duration-300 text-lg"
                                        :class="sec.open ? 'rotate-45' : ''">+</span>
                                </div>
                            </button>

                            <!-- Contenido -->
                            <div x-show="sec.open" x-transition:enter="transition-all ease-in-out duration-500"
                                x-transition:enter-start="max-h-0 opacity-0"
                                x-transition:enter-end="max-h-screen opacity-100"
                                x-transition:leave="transition-all ease-in-out duration-400"
                                x-transition:leave-start="max-h-screen opacity-100"
                                x-transition:leave-end="max-h-0 opacity-0" class="overflow-hidden bg-white">
                                <ul class="px-5 py-4 space-y-3">
                                    <template x-for="(it, i) in sec.items" :key="i">
                                        <li>
                                            <a :href="`{{ url('/publications') }}/${it.id}/click`"
                                                class="block text-[15px] text-neutral-800 hover:text-amber-700 underline decoration-amber-500 underline-offset-4 transition"
                                                target="_blank">
                                                <span class="font-medium">Artículo <span x-text="i + 1"></span>:</span>
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
                </div>
            </aside>
        </div>
    </section>


    <!-- Main Content -->
    <main class="flex-1 p-6 lg:p-8">

        <div class="mb-12 text-center">
            <a href="{{ url('/articulos') }}"
                class="inline-block w-full sm:w-auto px-4 sm:px-6 md:px-8 py-3 sm:py-4 text-sm sm:text-base md:text-lg bg-amber-700 rounded-2xl text-white font-semibold hover:bg-amber-800 transition-colors">
                Presiona para Ver Todos los Artículos Publicados de la Edición
            </a>
        </div>

        <!-- Video Destacado -->
        <section class="mb-16">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden ring-1 ring-neutral-200">

                <!-- Header -->
                <div class="px-4 sm:px-6 py-4 border-b border-neutral-200">
                    <h2 class="text-2xl sm:text-3xl font-bold text-amber-800">
                        Video Destacado de la Edición
                    </h2>
                </div>

                <!-- Contenido -->
                <div class="flex flex-col lg:flex-row gap-6 p-4 sm:p-6">

                    <!-- Video -->
                    <div class="w-full lg:w-1/2">
                        <div class="aspect-video rounded-xl overflow-hidden shadow">
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/RjT8pIoXvis"
                                title="Video destacado" frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="w-full lg:w-1/2 flex flex-col justify-center">
                        <h3 class="text-xl sm:text-2xl font-serif font-bold text-neutral-900">
                            Tesoros de mi ciudad: CChC Atacama presenta el nuevo Museo Regional de Atacama
                        </h3>

                        <p class="mt-3 sm:mt-4 text-neutral-600 leading-relaxed text-sm sm:text-base">
                            Este video presenta un recorrido por el nuevo Museo Regional de Atacama, destacando su diseño
                            moderno y su enfoque en la preservación del patrimonio histórico y cultural de la región.
                            A través de sus distintas salas, se aborda la evolución del territorio atacameño desde los
                            pueblos originarios hasta la actualidad, incorporando recursos audiovisuales y propuestas
                            educativas.
                            <br><br>
                            Este espacio se proyecta como un punto de encuentro para la memoria, la investigación y la
                            identidad regional.
                        </p>

                        <div class="mt-5">
                            <a href="https://www.youtube.com/watch?v=RjT8pIoXvis" target="_blank"
                                class="inline-flex items-center gap-2 text-amber-700 font-semibold hover:gap-3 transition-all">
                                Ver en YouTube
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Artículos destacados -->
        <section x-data="{
            posts: @js($featured),
            refreshPosts() {
                fetch('/featured')
                    .then(res => res.json())
                    .then(data => this.posts = data)
            }
        }" x-init="refreshPosts()">
            <div class="flex items-end justify-between mb-6">
                <h2 class="text-3xl font-bold text-amber-800">Artículos Populares de la edición: </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <template x-for="(p, i) in posts" :key="i">
                    <article
                        class="group bg-white rounded-xl shadow-sm overflow-hidden ring-1 ring-neutral-200/70 hover:ring-neutral-300 transition">
                        <a :href="p.url" target="_blank" class="relative block aspect-[16/10] overflow-hidden">
                            <img :src="p.img || '/img/default.jpg'" :alt="p.title"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-90">
                            </div>
                        </a>

                        <div class="p-4">
                            <a :href="p.url" target="_blank" class="block">
                                <h3 class="font-serif text-xl font-bold leading-tight text-neutral-900 group-hover:text-amber-800 transition"
                                    x-text="p.title"></h3>
                                <p class="mt-2 text-neutral-600 line-clamp-2" x-html="p.desc"></p>
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
                                <a :href="p.url" target="_blank"
                                    class="text-amber-700 font-semibold inline-flex items-center gap-1 hover:gap-2 transition-all">
                                    Leer más
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L12 6.414V17a1 1 0 11-2 0V6.414L6.707 9.707A1 1 0 015.293 8.293l5-5z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                </template>
            </div>
        </section>

        <!-- Biblioteca -->
        <section id="biblioteca" class="mt-16">
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
                    <ul class="flex gap-6 min-w-max snap-x snap-mandatory mb-4">
                        @foreach ($books as $book)
                            <li class="snap-start">
                                <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank"
                                    class="group block w-[150px] md:w-[180px]">
                                    <div
                                        class="relative rounded-md overflow-hidden shadow-md ring-1 ring-white/5 transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-lg">
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                                            class="h-[200px] md:h-[230px] w-full object-cover" />
                                    </div>
                                    <h3
                                        class="mt-2 text-[13px] md:text-sm font-extrabold uppercase leading-snug tracking-wide group-hover:text-amber-700 transition-colors break-words">
                                        {{ $book->title }}
                                    </h3>
                                    <p class="text-[11px] md:text-xs text-white/70 mt-1">
                                        {{ $book->author ?? 'Desconocido' }}
                                        @if ($book->publication_date)
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
