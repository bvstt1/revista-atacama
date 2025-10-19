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


    public function adminIndex()
    {
        $editions = Edition::orderByDesc('publication_date')->get();
        return view('editions.admin_index', compact('editions'));
    }

    public function toggleActive(Edition $edition)
    {
        if ($edition->is_active) {
            // Desactivar si ya estaba activa
            $edition->is_active = false;
            $edition->save();
        } else {
            // Activar solo esta edición y desactivar todas las demás
            Edition::query()->update(['is_active' => false]);

            $edition->is_active = true;
            $edition->save();
        }

        return redirect()->back()->with('success', 'Estado de la edición actualizado.');
    }

    public function deleteOrphanedEditions()
    {
        // Obtener todas las ediciones
        $editions = Edition::all();

        foreach ($editions as $edition) {
            // Verificar si tiene publicaciones
            $hasPublications = Publication::whereDate('publication_date', $edition->publication_date)->exists();

            // Si no tiene publicaciones, eliminarla
            if (!$hasPublications) {
                $edition->delete();
            }
        }

        return redirect()->back()->with('success', 'Ediciones sin publicaciones eliminadas automáticamente.');
    }



}
