<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Revista Historia de Atacama') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="min-h-screen flex flex-col bg-neutral-50 text-neutral-900">

    <!-- Header -->
    <header class="flex items-center justify-between px-6 py-4 bg-white shadow-md">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-amber-800 font-serif">Revista de Historia de Atacama</a>
        <nav class="hidden md:flex space-x-6 text-stone-700 font-medium">
            <a href="{{ url('/editorial') }}" class="hover:text-amber-700">Editorial</a>
            <a href="{{ url('/historia') }}" class="hover:text-amber-700">Historia</a>
            <a href="{{ url('/politica') }}" class="hover:text-amber-700">Política</a>
            <a href="{{ url('/educacion') }}" class="hover:text-amber-700">Educación</a>
            <a href="{{ url('/ciencia') }}" class="hover:text-amber-700">Ciencia</a>
            <a href="{{ url('/reseñas') }}" class="hover:text-amber-700">Reseñas</a>
        </nav>
        <a href="{{ url('/suscripcion') }}" class="hidden md:block ml-6 px-4 py-2 bg-amber-700 text-white rounded-full hover:bg-amber-800 transition-colors">Efemérides</a>
        <button class="md:hidden text-2xl text-amber-800" id="mobile-menu-button">☰</button>
    </header>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden flex-col space-y-2 bg-white px-6 py-4 shadow-md" id="mobile-menu">
        <a href="{{ url('/') }}" class="block py-2 text-stone-700 hover:text-amber-700">Inicio</a>
        <a href="{{ url('/reportajes') }}" class="block py-2 text-stone-700 hover:text-amber-700">Reportajes</a>
        <a href="{{ url('/ensayos') }}" class="block py-2 text-stone-700 hover:text-amber-700">Ensayos</a>
        <a href="{{ url('/galeria') }}" class="block py-2 text-stone-700 hover:text-amber-700">Galería</a>
        <a href="{{ url('/contacto') }}" class="block py-2 text-stone-700 hover:text-amber-700">Contacto</a>
        <a href="{{ url('/suscripcion') }}" class="block py-2 text-amber-700 font-semibold">Suscribirse</a>
    </div>

    <!-- Carrusel Principal -->
    <section 
        x-data="{
            current: 0, 
            slides: [
                { img: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600', title: 'Historia de Atacama', desc: 'Descubre los relatos más importantes de la región.' },
                { img: 'https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1600', title: 'Educación y Cultura', desc: 'Un análisis profundo de la educación en Chile.' },
                { img: 'https://images.unsplash.com/photo-1544965892-4c8c6b0f2c9f?q=80&w=1600', title: 'Ciencia y Política', desc: 'Avances científicos y su impacto en la política.' }
            ],
            interval: null,
            start() { this.interval = setInterval(() => { this.current = (this.current === this.slides.length - 1) ? 0 : this.current + 1 }, 5000) },
            stop() { clearInterval(this.interval); this.interval = null }
        }"
        x-init="start()" @mouseenter="stop()" @mouseleave="start()" 
        class="relative w-full h-[35vh] mt-6 overflow-hidden group"
    >
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="current === index" x-transition.opacity class="absolute inset-0">
                <img :src="slide.img" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end p-8 text-white">
                    <h2 class="text-3xl md:text-5xl font-bold" x-text="slide.title"></h2>
                    <p class="mt-2 text-lg md:text-xl" x-text="slide.desc"></p>
                </div>
            </div>
        </template>
        <!-- Botones -->
        <button @click="current = (current === 0) ? slides.length - 1 : current - 1" class="absolute top-1/2 left-6 -translate-y-1/2 bg-white/50 hover:bg-white/70 text-3xl p-2 rounded-full shadow transition">‹</button>
        <button @click="current = (current === slides.length - 1) ? 0 : current + 1" class="absolute top-1/2 right-6 -translate-y-1/2 bg-white/50 hover:bg-white/70 text-3xl p-2 rounded-full shadow transition">›</button>
    </section>

    <!-- Sección de Artículos Destacados -->

    <h1>Editorial: Nacimiento de una  Revista Digital</h1>

    <p> lo largo de la historia de la difusión del conocimiento, como de la reflexión y del pensamiento critico, han existido en el mundo muchos números uno de distintas revistas, en este caso, tenemos la firma convicción que no será así, debido a que la historia de Atacama, hunde sus raíces  en el lejano periodo  de cazadores recolectores, hace unos 11 mil años atrás. Por lo tanto hay mucho que investigar, reflexionar y socializar. Junto a ello, nos introduciremos en los problemas que nos plantea la ciencia, la política y la educación. De tal forma de poder generar antecedentes e información  en el marco de miradas criticas y propositivas para la discusión y la participación ciudadana. Junto a lo anterior, existirá una recomendación y reseña de libros de tal forma de orientar los aprendizajes analíticos y reflexivos  a la vez que se fomenta el gusto por la lectura.</p>

    <main class="flex-1 p-6 lg:p-8">
        <section class="mt-10">
            <h2 class="text-3xl font-bold text-amber-800 mb-6">Artículos Destacados</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <article class="bg-white rounded shadow overflow-hidden hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=800" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold">Historia Precolombina</h3>
                        <p class="mt-2 text-gray-600">Explora los primeros habitantes de Atacama y sus culturas originarias.</p>
                        <a href="#" class="text-amber-700 font-semibold mt-2 inline-block">Leer más</a>
                    </div>
                </article>
                <article class="bg-white rounded shadow overflow-hidden hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=800" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold">Política y Sociedad</h3>
                        <p class="mt-2 text-gray-600">Un análisis sobre los cambios políticos recientes en la región.</p>
                        <a href="#" class="text-amber-700 font-semibold mt-2 inline-block">Leer más</a>
                    </div>
                </article>
                <article class="bg-white rounded shadow overflow-hidden hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1544965892-4c8c6b0f2c9f?q=80&w=800" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold">Educación y Cultura</h3>
                        <p class="mt-2 text-gray-600">Descubre los programas educativos que impulsan la cultura atacameña.</p>
                        <a href="#" class="text-amber-700 font-semibold mt-2 inline-block">Leer más</a>
                    </div>
                </article>
            </div>
        </section>

        <!-- Secciones por Categoría -->
        <section class="mt-16">
            <h2 class="text-3xl font-bold text-amber-800 mb-6">Historia</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Repetir artículos por categoría -->
                <article class="bg-white rounded shadow overflow-hidden hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=800" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold">El Desierto de Atacama</h3>
                        <p class="mt-2 text-gray-600">Relatos sobre la geografía y sus habitantes a lo largo de la historia.</p>
                        <a href="#" class="text-amber-700 font-semibold mt-2 inline-block">Leer más</a>
                    </div>
                </article>
                <article class="bg-white rounded shadow overflow-hidden hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=800" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold">Minería y Sociedad</h3>
                        <p class="mt-2 text-gray-600">Cómo la minería ha moldeado la economía y cultura local.</p>
                        <a href="#" class="text-amber-700 font-semibold mt-2 inline-block">Leer más</a>
                    </div>
                </article>
                <!-- Más artículos -->
            </div>
        </section>

    </main>

    <footer class="bg-stone-900 text-white p-6 mt-10">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2025 Revista de Historia de Atacama. Todos los derechos reservados.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-amber-500">Facebook</a>
                <a href="#" class="hover:text-amber-500">Twitter</a>
                <a href="#" class="hover:text-amber-500">Instagram</a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>
</html>
