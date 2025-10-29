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
        <a href="{{ url('/') }}" class="flex items-center space-x-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Revista de Historia de Atacama" class="h-28 w-auto">
            <span class="pl-15 text-2xl font-bold text-amber-800 font-serif">
                Revista de Historia de Atacama
            </span>
        </a>

        <!-- Navegación principal -->
        <nav class="hidden md:flex space-x-6 text-stone-700 font-medium">
            <a href="{{ url('/editions') }}" 
            class="px-4 py-2 hover:bg-amber-700 hover:text-white rounded transition">
                Ediciones Publicadas
            </a>
            <a href="{{ url('/nosotros') }}" 
            class="px-4 py-2 hover:bg-amber-700 hover:text-white rounded transition">
                Nosotros
            </a>
            <a href="{{ url('/efemerides-public') }}"
            class="px-4 py-2 text-amber-700 hover:bg-amber-700 hover:text-white rounded transition">
                Efemérides
            </a>
        </nav>
        <div>
            
        </div>
        <!-- Botón menú móvil -->
        <button class="md:hidden text-2xl text-amber-800" id="mobile-menu-button">☰</button>
    </header>

    <!-- Menú móvil -->
    <div class="md:hidden hidden flex-col space-y-2 bg-white px-6 py-4 shadow-md" id="mobile-menu">
        <a href="{{ url('/') }}" class="block py-2 text-stone-700 hover:text-amber-700">Inicio</a>
        <a href="{{ url('/editions') }}" class="block py-2 text-stone-700 hover:text-amber-700">Ediciones Publicadas</a>
        <a href="{{ url('/nosotros') }}" class="block py-2 text-stone-700 hover:text-amber-700">Nosotros</a>
        <a href="{{ url('/efemerides-public') }}" class="block py-2 text-amber-700 font-semibold">Efemérides</a>
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-stone-950 text-stone-200 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-12 border-t border-stone-800">

            <!-- Columna 1: Identidad -->
            <div class="flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-bold text-amber-600 mb-4 font-serif">
                        Revista de Historia de Atacama
                    </h3>
                    <p class="text-sm text-stone-400 leading-relaxed">
                        Publicación digital dedicada a la investigación, educación y divulgación del patrimonio histórico,
                        social y cultural de la Región de Atacama.
                    </p>
                </div>
                <div class="mt-6 text-sm text-stone-500 space-y-1">
                    <p>ISSN 2957-0821</p>
                    <p>Copiapó — Región de Atacama, Chile</p>
                </div>
            </div>

            <!-- Columna 2: Equipo editorial -->
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-stone-400 mb-4">
                    Equipo Editorial
                </h4>
                <ul class="text-sm text-stone-300 space-y-3 leading-relaxed">

                    <li>
                        <span class="block font-semibold text-amber-500">Director</span>
                        <span>Guillermo Cortés Lutz</span>
                        <p class="text-stone-400 text-[13px]">
                            Profesor de Historia y Geografía · Doctor en Historia
                        </p>
                        <a href="mailto:gea_atacama@yahoo.es"
                        class="text-[13px] text-amber-500 hover:text-amber-400 transition">
                            gea_atacama@yahoo.es
                        </a>
                    </li>

                    <li>
                        <span class="block font-semibold text-amber-500">Editor Área Historia</span>
                        <span>Francisco Berríos Drolett</span>
                        <p class="text-stone-400 text-[13px]">
                            Profesor de Historia y Geografía · Magíster en Educación Superior
                        </p>
                    </li>

                    <li>
                        <span class="block font-semibold text-amber-500">Editor Área Educación</span>
                        <span>Alex Carvajal Villegas</span>
                        <p class="text-stone-400 text-[13px]">
                            Profesor de Biología y Ciencias · Magíster en Educación
                        </p>
                    </li>

                    <li>
                        <span class="block font-semibold text-amber-500">Editor Área Ciencias</span>
                        <span>Yery Marambio</span>
                        <p class="text-stone-400 text-[13px]">
                            Ingeniero en Pesca · Doctor en Ciencias Aplicadas
                        </p>
                    </li>

                    <li>
                        <span class="block font-semibold text-amber-500">Informática y Soporte Web</span>
                        <span>Bastián Velásquez</span>
                    </li>
                </ul>
            </div>

            <!-- Columna 3: Enlaces -->
            <div class="md:pl-8">
                <h4 class="text-sm font-semibold uppercase tracking-wider text-stone-400 mb-4">
                    Información
                </h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ url('/editions') }}" class="hover:text-amber-500 transition">
                            Ediciones Publicadas
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/efemerides') }}" class="hover:text-amber-500 transition">
                            Efemérides
                        </a>
                    </li>
                </ul>
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
    <script src="https://kit.fontawesome.com/782e1f1389.js" crossorigin="anonymous"></script>

</body>
</html>