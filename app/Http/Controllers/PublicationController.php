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
            'section_id' => 'required|exists:sections,id',
        ]);

        $path = $request->file('pdf_file')->store('pdfs', 'public');

        Publication::create([
            'title' => $request->title,
            'author' => $request->author,
            'section_id' => $request->section_id,
            'pdf_file' => '/storage/' . $path,
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
