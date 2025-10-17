<x-app-layout>
    <section class="bg-white pt-6 md:px-12 lg:px-24">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-amber-800 mb-4">Subir un Libro</h2>
            <p class="text-neutral-600 text-[15px] leading-relaxed mb-10">
                Completa el formulario para subir un libro a la biblioteca.
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-2xs p-8 md:p-12 border border-amber-800 border-2">

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

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-amber-800 mb-2">Título</label>
                    <input type="text" id="title" name="title" required
                        class="w-full p-3 rounded-lg border border-neutral-300 text-neutral-800 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- Autor -->
                <div>
                    <label for="author" class="block text-sm font-semibold text-amber-800 mb-2">Autor</label>
                    <input type="text" id="author" name="author"
                        class="w-full p-3 rounded-lg border border-neutral-300 text-neutral-800 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- Fecha de publicación -->
                <div>
                    <label for="publication_date" class="block text-sm font-semibold text-amber-800 mb-2">Fecha de Publicación</label>
                    <input type="date" id="publication_date" name="publication_date"
                        class="w-full p-3 rounded-lg border border-neutral-300 text-neutral-800 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- Portada -->
                <div>
                    <label for="cover" class="block text-sm font-semibold text-amber-800 mb-2">Portada</label>
                    <input type="file" id="cover" name="cover" accept="image/*" required
                        class="w-full p-3 rounded-lg border border-neutral-300 text-neutral-800 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- Archivo PDF -->
                <div>
                    <label for="pdf_file" class="block text-sm font-semibold text-amber-800 mb-2">Archivo PDF</label>
                    <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf" required
                        class="w-full p-3 rounded-lg border border-neutral-300 text-neutral-800 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="px-6 py-3 bg-amber-700 hover:bg-amber-800 text-white font-semibold rounded-full shadow">
                        Subir libro
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
