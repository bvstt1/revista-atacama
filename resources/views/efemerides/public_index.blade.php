@extends('layouts.hf')

@section('content')
<div class="mt-12 text-right px-6 md:px-6 lg:px-24 mb-6 mt-6">
    <a href="{{ url('/') }}" 
        class="inline-flex items-center gap-2 px-4 py-2 bg-amber-700 text-white font-semibold rounded-full hover:bg-amber-800 transition">
        ← Volver al inicio
    </a>
</div>
<div class="flex items-center justify-between px-6 md:px-12 lg:px-24 mb-6 mt-6">

    <div class="text-3xl font-bold text-amber-800">
        Efemérides de Atacama
    </div>
</div>

<section class="bg-white px-6 md:px-12 lg:px-24 pb-12"
         x-data="{
            efemerides: @js($efemerides),
            visible: @js(count($efemerides) > 8 ? 8 : count($efemerides)),
            loadMore() { this.visible += 6 }
         }">

    <div class="pt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @if(count($efemerides) <= 8)
            {{-- Mostrar todas las efemerides normalmente --}}
            <template x-for="(efemeride, index) in efemerides" :key="index">
                <div class="bg-amber-50 rounded-xl shadow-sm hover:shadow-md transition p-4 flex flex-col items-center">
                    <div class="text-center mb-2">
                        <p class="text-3xl font-bold text-amber-900 leading-none"
                           x-text="(() => {
                               const fecha = new Date(efemeride.date);
                               const dia = fecha.getDate();
                               const mes = fecha.toLocaleString('es-ES', { month: 'long' });
                               return dia + ' de ' + mes.charAt(0).toUpperCase() + mes.slice(1);
                           })()"></p>
                        <p class="text-xs text-neutral-500 mt-0.5"
                           x-text="new Date(efemeride.date).getFullYear()"></p>
                    </div>
                    <h3 class="font-semibold text-md text-stone-900 text-center mt-2"
                        x-text="efemeride.title"></h3>
                </div>
            </template>
        @else
            {{-- Loop infinito para más de 8 efemerides --}}
            <template x-for="i in visible" :key="i">
                <div class="bg-amber-50 rounded-xl shadow-sm hover:shadow-md transition p-4 flex flex-col items-center">
                    <div class="text-center mb-2">
                        <p class="text-3xl font-bold text-amber-900 leading-none"
                           x-text="(() => {
                               const ef = efemerides[(i-1) % efemerides.length];
                               const fecha = new Date(ef.date);
                               const dia = fecha.getDate();
                               const mes = fecha.toLocaleString('es-ES', { month: 'long' });
                               return dia + ' de ' + mes.charAt(0).toUpperCase() + mes.slice(1);
                           })()"></p>
                        <p class="text-xs text-neutral-500 mt-0.5"
                           x-text="new Date(efemerides[(i-1) % efemerides.length].date).getFullYear()"></p>
                    </div>
                    <h3 class="font-semibold text-md text-stone-900 text-center mt-2"
                        x-text="efemerides[(i-1) % efemerides.length].title"></h3>
                </div>
            </template>
        @endif
    </div>

    @if(count($efemerides) > 8)
        <div class="text-center mt-6">
            <button @click="loadMore()"
                    class="px-4 py-2 bg-amber-700 text-white font-semibold rounded-full hover:bg-amber-800 transition">
                Cargar más
            </button>
        </div>
    @endif
</section>



@endsection
