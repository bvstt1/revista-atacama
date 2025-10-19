<x-app-layout>
<div class="px-6 md:px-12 lg:px-24 mt-12">
    <h1 class="text-3xl font-bold text-amber-800 mb-6">Gestión de Ediciones</h1>

    <!-- Mensaje de éxito -->
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

    <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-amber-700 text-white">
            <tr>
                <th class="px-4 py-2 text-left">Título</th>
                <th class="px-4 py-2 text-left">Fecha</th>
                <th class="px-4 py-2 text-center">Activo</th>
                <th class="px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($editions as $edition)
                <tr class="border-b last:border-b-0 hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $edition->title }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($edition->publication_date)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 text-center">
                        @if($edition->is_active)
                            <span class="text-green-700 font-semibold">Sí</span>
                        @else
                            <span class="text-red-600 font-semibold">No</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center">
                        <form action="{{ route('editions.admin.toggle', $edition->id) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="px-3 py-1 rounded bg-amber-700 text-white hover:bg-amber-800 transition">
                                {{ $edition->is_active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
