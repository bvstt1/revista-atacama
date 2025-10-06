<?php

namespace App\Http\Controllers;

use App\Models\CarouselSlide;
use App\Models\Section;
use App\Models\Review;
use App\Models\Efemeride;

class HomeController extends Controller
{
    public function index()
    {
        $slides   = CarouselSlide::where('is_active',1)->orderBy('order')->get([
            'image_url as img', 'title', 'description', 'cta_text as ctaText', 'cta_url as ctaUrl'
        ]);

        // Armamos la estructura del “índice” con items
        $sections = Section::with('items')->where('is_active',1)->orderBy('order')->get();

        $reviews  = Review::where('is_published',1)->orderBy('order')->get();

        // (opcional) próximas efemérides
        $efemerides = Efemeride::where('is_published',1)
            ->orderBy('date','asc')->limit(10)->get();

        return view('welcome', compact('slides','sections','reviews','efemerides'));
    }
}
