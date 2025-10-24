<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Biblioteca de Libros
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
            {{ session('success') }}
            </div>
            <script>
            setTimeout(() => {
                const msg = document.getElementById('success-message');
                if (msg) {
                    msg.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                    msg.style.opacity = '0';
                    msg.style.transform = 'translateY(-10px)'; 
                    setTimeout(() => msg.remove(), 500);
                }
            }, 3000); 
            </script>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-end mb-4">
                <a href="{{ route('books.create') }}" class="px-4 py-2 bg-amber-700 text-white rounded hover:bg-amber-800 transition">
                    Nuevo Libro
                </a>
            </div>

            <table class="text-white w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="border px-4 py-2 text-left">Portada</th>
                        <th class="border px-4 py-2 text-left">Título</th>
                        <th class="border px-4 py-2 text-left">Autor</th>
                        <th class="border px-4 py-2 text-left">Año</th>
                        <th class="border px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="border px-4 py-2">
                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="h-16 w-12 object-cover rounded shadow-sm">
                                </td>
                                <td class="border px-4 py-2 font-medium">{{ $book->title }}</td>
                                <td class="border px-4 py-2">{{ $book->author ?? 'Desconocido' }}</td>
                                <td class="border px-4 py-2">{{ $book->publication_date ? \Carbon\Carbon::parse($book->publication_date)->format('Y') : '-' }}</td>
                                <td class="border px-4 py-2 flex flex-wrap gap-2">
                                    <a href="{{ route('books.edit', $book) }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
                                        Editar
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este libro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
