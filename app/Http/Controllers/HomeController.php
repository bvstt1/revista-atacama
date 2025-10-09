<?php

namespace App\Http\Controllers;

use App\Models\CarouselSlide;
use App\Models\Section;
use App\Models\Review;
use App\Models\Efemeride;
use App\Models\Book;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $slides   = CarouselSlide::where('is_active',1)->orderBy('order')->get([
            'image_url as img', 'title', 'description', 'cta_url as ctaUrl'
        ]);

        // Armamos la estructura del “índice” con items
        $sections = Section::with('items')->where('is_active',1)->orderBy('order')->get();

        $reviews = Review::where('is_published', 1)
            ->orderBy('order')
            ->get(['book_title','author','cover_url','excerpt','review_url','created_at'])
            ->map(function ($r) {
                $read = $r->reading_minutes ?? max(3, ceil(Str::wordCount($r->excerpt ?? '') / 220)); // aprox 220 wpm

                return [
                    //Mapeo para tu Blade (sin cambiar diseño/variables):
                    'bookTitle' => $r->book_title,          // r.bookTitle en el título grande
                    'title'     => $r->book_title,          // r.title en la lista lateral
                    'desc'      => $r->excerpt,
                    'img'       => $r->cover_url,
                    'url'       => $r->review_url,
                    'author'    => $r->author ?? 'Equipo Editorial',
                    'date'      => optional($r->created_at)->locale('es')->isoFormat('MMM YYYY') ?? '',
                    'read'      => "{$read} min",
                ];
            });

        // (opcional) próximas efemérides
        $efemerides = Efemeride::where('is_published',1)
            ->orderBy('date','asc')->limit(10)->get();

        $books = Book::orderBy('id', 'desc')
        ->get(['title', 'cover', 'url']);

        return view('welcome', compact('slides', 'sections', 'reviews', 'efemerides', 'books'));

    }
}
