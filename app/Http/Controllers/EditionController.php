<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Publication;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    // Muestra todas las ediciones
    public function index()
    {
        $editions = \App\Models\Edition::orderBy('publication_date', 'desc')->get();
        return view('editions.index', compact('editions'));
    }
    // Muestra artículos de una edición específica
    public function show(Edition $edition)
    {
        $sections = Publication::whereDate('publication_date', $edition->publication_date)
            ->with('section')
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy(fn($p) => $p->section->title ?? 'Sin sección');

        return view('editions.show', compact('edition', 'sections'));
    }



}
