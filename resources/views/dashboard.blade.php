<x-app-layout>
    <main class="bg-gray-900 min-h-screen flex items-center justify-center text-gray-100 p-6">
        <div class="bg-gray-800 rounded-2xl p-8 text-center  border-amber-600 shadow-lg max-w-lg w-full">

            <!-- Título -->
            <h2 class="text-3xl font-bold text-amber-700 mb-6">Panel de Administración</h2>

            <!-- Descripción -->
            <p class="text-gray-300 text-sm mb-8">
                Gestiona el contenido principal de <strong>Revista Atacama</strong>: publicaciones, reseñas, biblioteca y efemérides.
            </p>

            <!-- Opciones -->
            <div class="flex flex-col items-center space-y-4 text-sm font-medium">

                <a href="{{ route('publications.panel') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block">
                    Panel de Publicación
                </a>

                <a href="{{ route('reviews.panel') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block">
                    Panel de Reseña
                </a>

                <a href="{{ route('editions.admin.index') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block">
                    Panel de Ediciones
                </a>

                <a href="{{ route('books.panel') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block">
                    Panel de Biblioteca
                </a>

                <a href="{{ route('efemerides.panel') }}" 
                   class="bg-amber-700 hover:bg-amber-800 text-white py-2 px-6 rounded-xl shadow-md transition inline-block">
                    Panel de Efemérides
                </a>

            </div>

        </div>
    </main>
</x-app-layout>
