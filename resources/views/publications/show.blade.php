@extends('layouts.app')

@section('title', $efemeride->title)

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 40px 20px;">

    {{-- Título --}}
    <h1>{{ $efemeride->title }}</h1>

    {{-- Fecha --}}
    <p>
        {{ \Carbon\Carbon::parse($efemeride->date)->format('d/m/Y') }}
    </p>

    {{-- Autor (opcional) --}}
    @if(!empty($efemeride->author))
        <p>
            Autor: {{ $efemeride->author }}
        </p>
    @endif

    <hr>

    {{-- Contenido (CKEditor) --}}
    <div>
        {!! $efemeride->description !!}
    </div>

</div>
@endsection
