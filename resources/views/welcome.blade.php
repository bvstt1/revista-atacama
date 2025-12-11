@extends('layouts.hf')

@section('content')
    <!-- Carrusel Principal -->
 

    <section 
            x-data="{
                current: 0,
                slides: [
                    {
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
            }"
            x-init="start()" 
            @mouseenter="stop()" 
            @mouseleave="start()" 
            class="relative w-full h-[50vh] overflow-hidden group"
            >
        <template x-for="(slide, index) in slides" :key="index">
            <div 
                x-show="current === index" 
                x-transition.opacity 
                class="absolute inset-0"
            >
                <img 
                    :src="slide.img" 
                    :alt="slide.alt" 
                    class="w-full h-full object-cover" 
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-8 text-white">
                    <h2 class="text-3xl md:text-5xl font-bold" x-text="slide.title"></h2>
                    <p class="mt-2 text-lg md:text-xl" x-text="slide.description"></p>
                </div>
            </div>
        </template>

        <!-- Botones -->
        <button 
            @click="current = (current === 0) ? slides.length - 1 : current - 1" 
            class="absolute top-1/2 left-6 -translate-y-1/2 bg-white/50 hover:bg-white/70 text-3xl p-2 rounded-full shadow transition">
            ‹
        </button>
        <button 
            @click="current = (current === slides.length - 1) ? 0 : current + 1" 
            class="absolute top-1/2 right-6 -translate-y-1/2 bg-white/50 hover:bg-white/70 text-3xl p-2 rounded-full shadow transition">
            ›
        </button>
    </section>

    <!-- Efeméride Crítica Semanal -->
    <section 
        class="mt-10 md:mt-14 px-6 md:px-12 lg:px-24"
        x-data="{efemeride: @js($efemeride)}"
        >
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 md:p-8 shadow-sm flex flex-col md:flex-row items-start md:items-center gap-6 hover:shadow-md transition">
            
            <!-- Fecha + etiqueta -->
            <div class="shrink-0 text-center md:text-left">
                <span class="inline-block px-3 py-1 text-xs font-semibold bg-amber-700 text-white tracking-wide rounded-lg">
                    <span 
                        class="text-2xl md:text-3xl font-bold"
                        x-text="(() => {
                            const [y, m, d] = efemeride.date.split('-');
                            const date = new Date(y, m - 1, d);
                            const day = date.getDate();
                            const month = date.toLocaleString('es-ES', { month: 'long' });
                            return `${day} de ${month.charAt(0).toUpperCase() + month.slice(1)}`;
                        })()">
                    </span>
                </span>
                <!-- Efeméride crítica semanal -->
                <p class="mt-3 text-center md:text-left text-base md:text-lg font-bold text-amber-800">
                    Efeméride crítica semanal
                </p>
            </div>



            <!-- Contenido principal -->
            <div class="flex-1">
            <h3 class="font-serif text-3xl font-bold text-stone-900 leading-snug" x-text="efemeride.title"></h3>
            <p class="mt-2 text-stone-700 font-bold text-[15px] leading-relaxed" x-text="efemeride.description"></p>
            </div>
    </section>

    <!-- Índice estilo revista -->
    <section class="bg-white text-neutral-900 py-20 px-6 md:px-12 lg:px-24">
        <div class="max-w-7xl mx-auto grid gap-16 lg:grid-cols-2 items-start">

            <!--COLUMNA IZQUIERDA: EDITORIAL -->
            <article class="space-y-6 leading-relaxed">

                <!-- Título -->
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-amber-800 border-l-8 border-amber-600 pl-4">
                    Editorial:  Copiapó: Doscientos ochenta y un años de Historia.
                </h1>

                <!-- Contenido -->
                <div class="prose prose-neutral max-w-none text-justify">
                    <p>
                        El sol en Copiapó se alza una vez más sobre el valle, y con él, se cumple un nuevo aniversario de la fundación de San Francisco de la Selva de Copiapó, un hito que data del 8 de diciembre de 1744. Esta fecha no es un simple recuerdo en el calendario, sino el cimiento sobre el cual se erigió una de las ciudades más singulares y resistentes de Chile.
                    </p>

                    <p>
                        La historia de Copiapó es una crónica de contrastes: desde la promesa de la mítica Selva a la aridez circundante, desde un modesto asentamiento colonial hasta convertirse en el epicentro de la fiebre de la plata y el cobre que redefinió la economía del país. Fue aquí donde la minería no solo extrajo riqueza de la tierra, sino que también forjó el carácter de sus habitantes, dotándolos de una tenacidad a prueba de sequías y crisis económicas. Esta historia de Copiapó es, esencialmente, una crónica de resiliencia frente a las fuerzas de la naturaleza.
                    </p>

                    <p>
                        Desde el siglo XVIII, el destino de la ciudad ha estado indisolublemente ligado a la escasa, pero vital, agua del Río Copiapó. Las mercedes de agua coloniales dictaron el pulso de la economía, primero agrícola y luego minera, generando tensiones por su uso que se arrastran hasta hoy. El río, columna vertebral del valle, ha sido testigo y protagonista de un conflicto histórico, donde la gestión del recurso define la supervivencia y la prosperidad de sus habitantes.
                    </p>

                    <p>
                        Pero la naturaleza ha desafiado a Copiapó no solo con la sequía, sino también con el movimiento de la tierra, tema que ha sido investigado por el Profesor y Magíster, Rodrigo Zalaquett Fuente-Alba, en su artículo “El Terremoto de 1918 en Copiapó y la fotografía instrumental de José Olivares Valdivia”, artículo que en esta edición se da a conocer a la comunidad. Eventos como los grandes terremotos de 1918 y 1922 marcaron profundas cicatrices en la infraestructura y en la memoria colectiva. Estas catástrofes del siglo XX no fueron solo episodios de destrucción; se convirtieron en hitos de reconstrucción y afirmación de la identidad local, recordándonos la vulnerabilidad constante y la capacidad inagotable de levantarse.
                    </p>
                    <p>
                        Al rememorar el hito histórico de la fundación, no solo celebramos el acto administrativo del gobernador Manso de Velasco, a través de su Corregidor Francisco Cortés Cartavío y Santelices y Roldán, sino la persistencia de un asentamiento humano en un entorno desafiante. Es fundamental que, como educadores e historiadores, continuemos explorando las capas de este pasado. Debemos ir más allá de los próceres y las grandes minas, para rescatar las historias sociales de los arrieros, los mineros, las mujeres que sostuvieron el hogar y la cultura que floreció a la sombra de los yacimientos.                        
                    </p>
                    <p>
                        El aniversario es una invitación a la reflexión: ¿Qué significa ser copiapino hoy? Significa ser heredero de la tradición minera, custodio de la primera línea férrea de Chile, y testigo de la resiliencia ante los desafíos naturales. Nuestra revista se compromete a seguir iluminando estas narrativas, asegurando que la memoria histórica de la capital de Atacama permanezca tan viva y resplandeciente como el metal que la hizo grande.                        
                    </p>
                </div>

                <!-- Firma -->
                <div class="pt-6 border-t border-neutral-200">
                    <p class="italic text-amber-700 font-semibold">— Prof. Francisco Berríos Drolett </p>
                    <p class="italic font-medium opacity-60">Magister en Educación Superior </p>
                    <p class="italic font-medium opacity-60">Editor Historia RHA</p>
                </div>
            </article>

            <!-- 📚 COLUMNA DERECHA: ÍNDICE -->
            <aside
                x-data="{sections: @js(
                    $sections->map(fn($s)=>[
                        'title' => $s->title,
                        'open' => false,
                        'items' => $s->items->map(fn($it)=>[
                            'id' => $it->id,
                            'title' => $it->title,
                            'author' => $it->author,
                            'pdf_file' => $it->pdf_file,
                        ])
                    ])
                )}"
                class="bg-neutral-50 border border-neutral-200 rounded-2xl shadow-md p-6 sticky top-24"
            >
                <h2 class="text-3xl font-serif font-bold text-amber-800 mb-2">Índice de la Revista</h2>

                @if(isset($editionDate))
                    <p class="text-sm text-neutral-500 mb-6">
                        Edición N°2 — {{ \Carbon\Carbon::parse($editionDate)->locale('es')->isoFormat('D [de] MMMM YYYY') }}
                    </p>
                @endif

                <!-- Acordeones -->
                <div class="space-y-4">
                    <template x-for="(sec, s) in sections" :key="s">
                        <div class="border border-neutral-200 rounded-lg overflow-hidden shadow-sm">
                            <!-- Cabecera -->
                            <button
                                class="w-full flex items-center justify-between bg-neutral-900 text-white px-5 py-4 text-left transition hover:bg-neutral-800"
                                @click="sec.open = !sec.open"
                            >
                                <span class="font-semibold" x-text="sec.title"></span>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs bg-white/10 px-2 py-0.5 rounded"
                                        x-text="sec.items.length + ' artículos'"></span>
                                    <span class="transition-transform duration-300 text-lg"
                                        :class="sec.open ? 'rotate-45' : ''">+</span>
                                </div>
                            </button>

                            <!-- Contenido -->
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
                                        <li>
                                            <a 
                                                :href="`{{ url('/publications') }}/${it.id}/click`"
                                                class="block text-[15px] text-neutral-800 hover:text-amber-700 underline decoration-amber-500 underline-offset-4 transition"
                                                target="_blank"
                                            >
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
                <h2 class="text-3xl font-bold text-amber-800">Artículos Populares de la edición: </h2>
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