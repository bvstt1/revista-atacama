<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function panel()
    {
        return view('books.panel');
    }
    /**
     * Mostrar el formulario para crear un libro.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Guardar un libro en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'cover' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB
            'pdf_file' => 'required|file|mimes:pdf|max:10240', // 10MB
        ]);

        // Subir archivos
        $coverPath = $request->file('cover')->store('books/covers', 'public');
        $pdfPath   = $request->file('pdf_file')->store('books/pdfs', 'public');

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publication_date' => $request->publication_date,
            'cover' => $coverPath,
            'pdf_file' => $pdfPath,
        ]);

        return redirect()->back()->with('success', 'Libro subido correctamente');
    }

    /**
     * Mostrar listado de libros (opcional).
     */
    public function index()
    {
        $books = Book::orderBy('publication_date', 'desc')->get();
        return view('books.index', compact('books'));
    }

    /**
     * Mostrar un libro específico.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

        public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'cover' => 'nullable|image|max:5120',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('books/covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('books/pdfs', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
