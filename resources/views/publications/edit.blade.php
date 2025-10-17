<x-app-layout>
    <section class="bg-white pt-6 md:px-12 lg:px-24">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-amber-800 mb-4">Editar Publicación</h2>
        </div>

        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-2xs p-8 md:p-12 border border-amber-800 border-2">

            <form action="{{ route('publications.update', $publication) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-amber-800 mb-2">Título</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $publication->title) }}" required
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm">
                </div>

                <!-- Autor -->
                <div>
                    <label for="author" class="block text-sm font-semibold text-amber-800 mb-2">Autor</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $publication->author) }}"
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm">
                </div>

                <!-- Sección -->
                <div>
                    <label for="section_id" class="block text-sm font-semibold text-amber-800 mb-2">Sección</label>
                    <select id="section_id" name="section_id" required
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm">
                        <option value="">Selecciona una sección</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" @selected(old('section_id', $publication->section_id) == $section->id)>
                                {{ $section->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Descripción -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-amber-800 mb-2">Descripción</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm">{{ old('description', $publication->description) }}</textarea>
                </div>

                <!-- Fecha de Publicación -->
                <div>
                    <label for="publication_date" class="block text-sm font-semibold text-amber-800 mb-2">Fecha de Publicación</label>
                    <input type="date" id="publication_date" name="publication_date"
                        value="{{ old('publication_date', $publication->publication_date?->format('Y-m-d')) }}"
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm">
                </div>

                <!-- Imagen -->
                <div>
                    <label for="image_file" class="block text-sm font-semibold text-amber-800 mb-2">Imagen del artículo</label>
                    <input type="file" id="image_file" name="image_file" accept="image/*"
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm">
                    @if($publication->image_file)
                        <img src="{{ asset('storage/' . $publication->image_file) }}" alt="{{ $publication->title }}" class="mt-2 h-32 w-auto object-cover rounded">
                    @endif
                </div>

                <!-- PDF -->
                <div>
                    <label for="pdf_file" class="block text-sm font-semibold text-amber-800 mb-2">Archivo PDF</label>
                    <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf"
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm">
                    @if($publication->pdf_file)
                        <p class="mt-2 text-sm text-gray-600">Archivo actual: <a href="{{ asset('storage/' . $publication->pdf_file) }}" target="_blank">{{ basename($publication->pdf_file) }}</a></p>
                    @endif
                </div>

                <!-- Botón Guardar -->
                <div class="text-center">
                    <button type="submit"
                        class="px-6 py-3 bg-amber-700 hover:bg-amber-800 text-white font-semibold rounded-full shadow transition shadow-lg">
                        Actualizar publicación
                    </button>
                </div>

            </form>
        </div>
    </section>
</x-app-layout>
