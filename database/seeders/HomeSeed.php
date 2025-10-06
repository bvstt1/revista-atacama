<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarouselSlide;
use App\Models\Section;
use App\Models\SectionItem;
use App\Models\Review;

class HomeSeed extends Seeder {
    public function run(){
        CarouselSlide::truncate();
        Section::truncate();
        SectionItem::truncate();
        Review::truncate();

        CarouselSlide::insert([
            [
                'image_url' => 'https://tu-cdn/atacama1.jpg',
                'title' => 'Paisaje del Desierto de Atacama',
                'description' => '…',
                'cta_text' => 'Leer más',
                'cta_url' => url('/editorial'),
                'order' => 1, 'is_active' => true
            ],
            // …
        ]);

        $sec = Section::create(['title'=>'Reseña de libros','order'=>4,'is_active'=>true]);
        SectionItem::create([
            'section_id'=>$sec->id, 'title'=>'Atacama, memorias del salitre',
            'author'=>'M. Pérez','url'=>url('/reseñas/memorias-salitre'),'order'=>1
        ]);

        Review::insert([
            [
                'book_title'=>'Atacama, memorias del salitre',
                'author'=>'M. Pérez',
                'cover_url'=>'https://tu-cdn/covers/salitre.jpg',
                'excerpt'=>'Una reseña breve…',
                'review_url'=>url('/reseñas/memorias-salitre'),
                'order'=>1, 'is_published'=>true
            ],
        ]);
    }
}
