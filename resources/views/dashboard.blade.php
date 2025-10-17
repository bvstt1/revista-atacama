<x-app-layout>
    <main class="bg-white from-amber-50 to-amber-100 min-h-screen flex items-center justify-center text-gray-800">
        <div class="bg-white rounded-2xl p-8 text-center border border-amber-800">

            <!-- Título -->
            <h2 class="text-3xl font-bold text-amber-800 mb-6">Panel de Administración</h2>

            <!-- Descripción -->
            <p class="text-stone-600 text-sm mb-8">
                Gestiona el contenido principal de <strong>Revista Atacama</strong>: publicaciones, reseñas, biblioteca y efemérides.
            </p>

            <!-- Opciones -->
            <div class="flex flex-col items-center space-y-4 text-sm font-medium">
                <a href="{{ route('publications.create') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block px-6">
                    Crear Publicación
                </a>

                <a href="{{ route('reviews.create') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block">
                    Crear Reseña
                </a>

                <a href="{{ route('books.create') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block">
                    Añadir Libro
                </a>

                <a href="{{ route('efemerides.create') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block">
                    Añadir Efeméride
                </a>
            </div>

        </div>
    </main>
</x-app-layout>
