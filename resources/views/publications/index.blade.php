<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Publicaciones
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            <!-- Botón Crear nuevo -->
            <div class="mb-4 text-right">
                <a href="{{ route('publications.create') }}" 
                   class="px-4 py-2 bg-amber-700 text-white rounded hover:bg-amber-800 transition">
                    Crear nueva publicación
                </a>
            </div>

            <!-- Tabla de publicaciones -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($publications as $publication)
                        <tr>
                            <!-- Imagen -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($publication->image_file)
                                    <img src="{{ asset('storage/' . $publication->image_file) }}" 
                                         alt="{{ $publication->title }}" 
                                         class="h-12 w-12 object-cover rounded">
                                @else
                                    <span class="text-gray-400">Sin imagen</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">{{ $publication->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $publication->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $publication->section->title ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $publication->publication_date?->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                <a href="{{ route('publications.edit', $publication) }}" 
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Editar</a>
                                <form action="{{ route('publications.destroy', $publication) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition"
                                            onclick="return confirm('¿Seguro que quieres eliminar esta publicación?')">
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
    </div>
</x-app-layout>
