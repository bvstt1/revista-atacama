<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de Efemérides
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
                <a href="{{ route('efemerides.create') }}" class="px-4 py-2 bg-amber-700 text-white rounded hover:bg-amber-800 transition">
                    Nueva Efeméride
                </a>
            </div>

            <table class="text-white w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="border px-4 py-2 text-left">Fecha</th>
                        <th class="border px-4 py-2 text-left">Título</th>
                        <th class="border px-4 py-2 text-left">Descripción</th>
                        <th class="border px-4 py-2 text-left">Imagen</th>
                        <th class="border px-4 py-2 text-left">Publicado</th>
                        <th class="border px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($efemerides as $e)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($e->date)->format('d/m/Y') }}</td>
                            <td class="border px-4 py-2">{{ $e->title }}</td>
                            <td class="border px-4 py-2">{{ Str::limit($e->description, 50) }}</td>
                            <td class="border px-4 py-2">
                                @if($e->image_url)
                                    <img src="{{ $e->image_url }}" alt="{{ $e->title }}" class="h-16 w-16 object-cover rounded">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $e->is_published ? 'Sí' : 'No' }}</td>
                            <td class="border px-4 py-2 flex gap-2">
                                <a href="{{ route('efemerides.edit', $e) }}" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
                                    Editar
                                </a>
                                <form action="{{ route('efemerides.destroy', $e) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta efeméride?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm">
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
