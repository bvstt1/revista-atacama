<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Libro
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Título</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required
                        class="w-full p-3 rounded-lg bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- Autor -->
                <div>
                    <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">Autor</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}"
                        class="w-full p-3 rounded-lg bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- Fecha de publicación -->
                <div>
                    <label for="publication_date" class="block text-sm font-semibold text-gray-700 mb-2">Fecha de publicación</label>
                    <input type="date" id="publication_date" name="publication_date" value="{{ old('publication_date', $book->publication_date?->format('Y-m-d')) }}"
                        class="w-full p-3 rounded-lg bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- Portada -->
                <div>
                    <label for="cover" class="block text-sm font-semibold text-gray-700 mb-2">Portada</label>
                    <input type="file" id="cover" name="cover" accept="image/*"
                        class="w-full p-3 rounded-lg bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="mt-2 h-32 w-auto object-cover rounded">
                    @endif
                </div>

                <!-- PDF -->
                <div>
                    <label for="pdf_file" class="block text-sm font-semibold text-gray-700 mb-2">Archivo PDF</label>
                    <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf"
                        class="w-full p-3 rounded-lg bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    @if($book->pdf_file)
                        <p class="mt-2 text-sm text-gray-600">Archivo actual: <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank" class="underline text-amber-700">{{ $book->pdf_file }}</a></p>
                    @endif
                </div>

                <!-- Botón Guardar -->
                <div class="text-center">
                    <button type="submit" class="px-6 py-3 bg-amber-700 hover:bg-amber-800 text-white font-semibold rounded-full shadow">
                        Actualizar Libro
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
