<x-layout.app>
    <!-- Sección Contacto -->
    <section class="mt-16 px-6 md:px-12 lg:px-24">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-amber-800 mb-4">Contáctanos</h2>
            <p class="text-neutral-600 text-[15px] leading-relaxed mb-10">
                ¿Tienes dudas, sugerencias o deseas colaborar con nosotros? Completa el formulario y nos pondremos en contacto contigo lo antes posible.
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-neutral-100 rounded-2xl shadow-md p-8 md:p-12 border border-amber-800 border-2">
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-amber-800 mb-2">Nombre</label>
                    <input type="text" id="name" name="name" required
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-lg">
                </div>

                <!-- Correo -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-amber-800 mb-2">Correo electrónico</label>
                    <input type="email" id="email" name="email" required
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-lg">
                </div>

                <!-- Asunto -->
                <div>
                    <label for="subject" class="block text-sm font-semibold text-amber-800 mb-2">Asunto</label>
                    <input type="text" id="subject" name="subject" required
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-lg">
                </div>

                <!-- Mensaje -->
                <div>
                    <label for="message" class="block text-sm font-semibold text-amber-800 mb-2">Mensaje</label>
                    <textarea id="message" name="message" rows="6" required
                        class="w-full p-3 rounded-lg bg-white border border-neutral-300 text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-lg"></textarea>
                </div>

                <!-- Botón Enviar -->
                <div class="text-center">
                    <button type="submit"
                        class="px-6 py-3 bg-amber-700 hover:bg-amber-800 text-white font-semibold rounded-full shadow transition shadow-lg">
                        Enviar mensaje
                    </button>
                </div>
            </form>
        </div>

        <!-- Información de contacto adicional -->
        <div class="mt-12 max-w-4xl mx-auto text-center space-y-4">
            <p class="text-neutral-600">También puedes escribirnos directamente a:</p>
            <a href="mailto:revista@historiaatacama.cl"
                class="text-amber-800 hover:text-amber-500 text-sm font-semibold transition">
                revista@historiaatacama.cl
            </a>
            <p class="text-neutral-500 text-sm">
                Dirección: Universidad de Atacama · Copiapó, Chile
            </p>
        </div>
    </section>
</x-layout.app>
