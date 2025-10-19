<?php

namespace App\Http\Controllers;

use App\Models\CarouselSlide;
use App\Models\Section;
use App\Models\Publication;
use App\Models\Review;
use App\Models\Efemeride;
use App\Models\Book;
use App\Models\Edition;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Slides activos
        $slides = CarouselSlide::where('is_active',1)
            ->orderBy('order')
            ->get(['image_url as img', 'title', 'description', 'cta_url as ctaUrl']);

        // Obtener la edición activa más próxima
        $activeEdition = Edition::where('is_active', true)
            ->orderBy('publication_date', 'asc')
            ->first();

        if ($activeEdition) {
            $editionDate = $activeEdition->publication_date;

            // Secciones solo con artículos de la edición activa
            $sections = Section::with(['items' => function($query) use($editionDate){
                $query->whereDate('publication_date', $editionDate)
                    ->orderBy('order')
                    ->orderByDesc('publication_date');
            }])->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->filter(fn($s) => $s->items->isNotEmpty())
            ->values();

            // Artículos destacados (top 3)
            $featured = Publication::popular()
                ->whereDate('publication_date', $editionDate)
                ->get()
                ->map(function ($p) {
                    return [
                        'title' => $p->title,
                        'desc'  => $p->description,
                        'img'   => $p->image_file ? asset('storage/' . $p->image_file) : asset('/img/default.jpg'),
                        'url'   => route('publications.click', $p->id),
                        'author'=> $p->author ?? 'Equipo Editorial',
                        'date'  => $p->publication_date ? $p->publication_date->format('M Y') : '',
                        'read'  => '6 min',
                        'clicks'=> $p->clicks,
                    ];
                })->toArray();
        } else {
            $editionDate = null;
            $sections = collect();
            $featured = [];
        }

        // Reviews, efemérides y libros (sin cambios)
        $reviews = Review::where('is_published', 1)
            ->orderBy('order')
            ->get(['book_title','author','cover_url','excerpt','review_url','created_at'])
            ->map(function ($r) {
                $read = $r->reading_minutes ?? max(3, ceil(Str::wordCount($r->excerpt ?? '') / 220));
                return [
                    'bookTitle' => $r->book_title,
                    'title'     => $r->book_title,
                    'desc'      => $r->excerpt,
                    'img'       => $r->cover_url,
                    'url'       => $r->review_url,
                    'author'    => $r->author ?? 'Equipo Editorial',
                    'date'      => optional($r->created_at)->locale('es')->isoFormat('MMM YYYY') ?? '',
                    'read'      => "{$read} min",
                ];
            });

        $efemerides = Efemeride::where('is_published',1)
            ->orderBy('date','asc')->limit(10)->get();

        $books = Book::orderBy('id', 'asc')
            ->get(['title','author','cover','pdf_file','publication_date']);

        return view('welcome', compact('slides', 'sections', 'reviews', 'efemerides', 'books', 'featured', 'editionDate'));
    }
}
