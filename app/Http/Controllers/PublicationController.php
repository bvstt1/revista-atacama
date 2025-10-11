<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
