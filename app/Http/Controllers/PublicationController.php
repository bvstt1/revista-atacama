<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Section;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function panel()
    {
        return view('publications.panel');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::orderBy('publication_date', 'desc')->get();
        return view('publications.index', compact('publications'));
    }

    public function incrementClicks(Publication $publication)
    {
        $publication->increment('clicks');
        return redirect()->away(asset('storage/' . $publication->pdf_file));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = \App\Models\Section::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('publications.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'pdf_file' => 'required|file|mimes:pdf|max:10240', // máximo 10MB
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'order' => 'nullable|integer',
            'clicks' => 'nullable|integer',
            'image_file' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // máximo 5MB
            'section_id' => 'required|exists:sections,id',
        ]);

        $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');
        $imagePath = $request->file('image_file')->store('img/publications', 'public');

        Publication::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'publication_date' => $request->publication_date,
            'order' => $request->order ?? 0,
            'clicks' => $request->clicks ?? 0,
            'section_id' => $request->section_id,
            'image_file' => $imagePath,  // solo "img/publications/archivo.jpg"
            'pdf_file' => $pdfPath,      // solo "pdfs/archivo.pdf"
        ]);

        return redirect()->back()->with('success', 'Archivo subido correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        $sections = \App\Models\Section::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('publications.edit', compact('publication', 'sections'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        // Validación
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // opcional en edición
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'order' => 'nullable|integer',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // opcional en edición
            'section_id' => 'required|exists:sections,id',
        ]);

        // Subir archivos si se cargan
        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        } else {
            $data['pdf_file'] = $publication->pdf_file;
        }

        if ($request->hasFile('image_file')) {
            $data['image_file'] = $request->file('image_file')->store('img/publications', 'public');
        } else {
            $data['image_file'] = $publication->image_file;
        }

        // Actualizar
        $publication->update($data);

        return redirect()->route('publications.index')->with('success', 'Publicación actualizada correctamente');
    }


    public function featured()
    {
        $featured = Publication::popular()->get()->map(function ($p) {
            return [
                'title'  => $p->title,
                'desc'   => $p->description,
                'img'    => $p->image_file ? asset('storage/' . $p->image_file) : asset('/img/default.jpg'),
                'url'    => route('publications.click', $p->id),
                'author' => $p->author ?? 'Equipo Editorial',
                'date'   => $p->publication_date ? $p->publication_date->format('M Y') : '',
                'clicks' => $p->clicks,
            ];
        });

        return response()->json($featured);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function indexPublic()
    {
        $sections = \App\Models\Section::with(['items' => function($query){
            $query->orderBy('publication_date', 'desc');
        }])->where('is_active', true)
        ->orderBy('order')
        ->get();

        return view('publications.public_index', compact('sections'));
    }

    
}
