<x-app-layout>
    <!-- Sección Subida de Artículos -->
    <section class="bg-gray-50 dark:bg-gray-900 pt-6 md:px-12 lg:px-24 transition-colors duration-300">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-amber-800 dark:text-amber-600 mb-4">
                Subir un Artículo
            </h2>
            <p class="text-gray-600 dark:text-gray-300 text-[15px] leading-relaxed mb-10">
                Completa el formulario para subir un artículo o PDF a la revista. Asegúrate de seleccionar la sección correcta.
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow p-8 md:p-12 dark:border-amber-600 transition-colors duration-300">

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div id="success-message"
                     class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded mb-5">
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

            <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Título</label>
                    <input type="text" id="title" name="title" required
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-600 transition">
                </div>

                <!-- Autor -->
                <div>
                    <label for="author" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Autor</label>
                    <input type="text" id="author" name="author"
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-600 transition">
                </div>

                <!-- Sección -->
                <div>
                    <label for="section_id" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Sección</label>
                    <select id="section_id" name="section_id" required
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-600 transition">
                        <option value="">Selecciona una sección</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Descripción -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Descripción</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-600 transition"></textarea>
                </div>

                <!-- Fecha de Publicación -->
                <div>
                    <label for="publication_date" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Fecha de Publicación</label>
                    <input type="date" id="publication_date" name="publication_date"
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-600 transition">
                </div>

                <!-- Imagen del artículo -->
                <div>
                    <label for="image_file" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Imagen del artículo</label>
                    <input type="file" id="image_file" name="image_file" accept="image/*" required
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-600 transition">
                </div>

                <!-- Archivo PDF -->
                <div>
                    <label for="pdf_file" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Archivo PDF</label>
                    <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf" required
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-600 transition">
                </div>

                <!-- Botón Guardar -->
                <div class="text-center">
                    <button type="submit"
                        class="px-6 py-3 bg-amber-700 hover:bg-amber-800 dark:bg-amber-600 dark:hover:bg-amber-700 text-white font-semibold rounded-full shadow transition">
                        Subir artículo
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
