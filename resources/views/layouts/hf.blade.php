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
            <a href="{{ url('/normas') }}" class="hover:text-amber-700">NORMAS EDITORIALES</a>
            <a href="{{ url('/editions') }}" class="hover:text-amber-700">EDICIONES PUBLICADAS</a>
            <a href="{{ url('/nosotros') }}" class="hover:text-amber-700">NOSOTROS</a>
            <a href="{{ url('/contacto') }}" class="hover:text-amber-700">CONTACTO</a>
        </nav>

        <!-- Botón destacado -->
        <a href="{{ url('/efemerides') }}"
            class="hidden md:block ml-6 px-4 py-2 bg-amber-700 text-white rounded-full hover:bg-amber-800 transition-colors">
            Efémerides
        </a>

        <!-- Botón menú móvil -->
        <button class="md:hidden text-2xl text-amber-800" id="mobile-menu-button">☰</button>
    </header>

    <!-- Menú móvil -->
    <div class="md:hidden hidden flex-col space-y-2 bg-white px-6 py-4 shadow-md" id="mobile-menu">
        <a href="{{ url('/') }}" class="block py-2 text-stone-700 hover:text-amber-700">Inicio</a>
        <a href="{{ url('/normas') }}" class="block py-2 text-stone-700 hover:text-amber-700">NORMAS EDITORIALES</a>
        <a href="{{ url('/ediciones') }}" class="block py-2 text-stone-700 hover:text-amber-700">EDICIONES PUBLICADAS</a>
        <a href="{{ url('/nosotros') }}" class="block py-2 text-stone-700 hover:text-amber-700">NOSOTROS</a>
        <a href="{{ url('/contacto') }}" class="block py-2 text-stone-700 hover:text-amber-700">CONTACTO</a>
        <a href="{{ url('/efemerides') }}" class="block py-2 text-amber-700 font-semibold">EFÉMERIDES</a>
    </div>

    @yield('content')

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
                <li><a href="{{ url('/normas') }}" class="hover:text-amber-500 transition">Normas Editoriales</a></li>
                <li><a href="{{ url('/editions') }}" class="hover:text-amber-500 transition">Ediciones Publicadas</a></li>
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