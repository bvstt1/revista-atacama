<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 pt-6 md:px-12 lg:px-24 transition-colors duration-300">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-amber-700 dark:text-amber-600 mb-4">Crear Efeméride</h2>
            <p class="text-gray-600 dark:text-gray-300 text-[15px] leading-relaxed mb-10">
                Completa el formulario para agregar una nueva efeméride.
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow p-8 md:p-12 dark:border-amber-500 transition-colors duration-300">

            @if(session('success'))
                <div id="success-message" class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded mb-5">
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

            <form action="{{ route('efemerides.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Fecha -->
                <div>
                    <label for="date" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                        Fecha (dd/mm/yyyy)
                    </label>
                    <input type="text" id="date" name="date" required placeholder="Ej: 19/10/2025"
                        value="{{ old('date') }}"
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-600 transition" 
                        pattern="\d{2}/\d{2}/\d{4}" title="Formato: dd/mm/yyyy">
                </div>

                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Título</label>
                    <input type="text" id="title" name="title" required
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-600"
                        value="{{ old('title') }}">
                </div>

                <!-- Descripción -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Descripción</label>
                    <textarea id="description" name="description" rows="4">
                    {{ old('description') }}
                    </textarea>
                </div>

                <!-- Publicado -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                        class="h-5 w-5 text-amber-700 focus:ring-amber-600 border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700">
                    <label for="is_published" class="text-sm font-semibold text-gray-800 dark:text-gray-200">Publicado</label>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="px-6 py-3 bg-amber-700 hover:bg-amber-800 dark:bg-amber-600 dark:hover:bg-amber-700 text-white font-semibold rounded-full shadow transition-colors duration-300">
                        Guardar Efeméride
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
