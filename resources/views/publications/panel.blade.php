<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel de Publicaciones
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Botón Crear nueva publicación -->
            <a href="{{ route('publications.create') }}"
               class="flex flex-col items-center justify-center px-6 py-8 bg-amber-700 text-white rounded-lg shadow hover:bg-amber-800 transition">
                <span class="font-bold">Crear nueva publicación</span>
            </a>

            <!-- Botón Ver todas las publicaciones -->
            <a href="{{ route('publications.index') }}"
               class="flex flex-col items-center justify-center px-6 py-8 bg-gray-100 text-gray-800 rounded-lg shadow hover:bg-gray-200 transition p-6">
                <span class="font-bold">Ver/Editar/Eliminar todas las publicaciones</span>
            </a>

        </div>
    </div>
</x-app-layout>
