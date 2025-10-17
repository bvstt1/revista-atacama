<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel de Libros
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 flex flex-col md:flex-row gap-4 justify-center">
            
            <a href="{{ route('books.index') }}" 
               class="flex-1 px-6 py-4 bg-amber-700 text-white font-semibold rounded-lg text-center hover:bg-amber-800 transition">
               Ver todos los libros
            </a>

            <a href="{{ route('books.create') }}" 
               class="flex-1 px-6 py-4 bg-green-600 text-white font-semibold rounded-lg text-center hover:bg-green-700 transition">
               Crear nuevo libro
            </a>

        </div>
    </div>
</x-app-layout>
