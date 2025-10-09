<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarouselSlide;
use App\Models\Section;
use App\Models\Review;
use App\Models\Book;

class HomeSeed extends Seeder
{
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // Desactivar FK (doble seguro)
            Schema::disableForeignKeyConstraints();
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Truncar en orden: hijos -> padres
            Review::truncate();
            Section::truncate();
            CarouselSlide::truncate();

            // Reactivar FK
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            Schema::enableForeignKeyConstraints();

            Model::unguarded(function () {

                // =========================
                // Carrusel (home)
                // =========================
                CarouselSlide::create([
                    'image_url'   => 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?q=80&w=2000&auto=format&fit=crop',
                    'title'       => 'Historia Viva de Atacama',
                    'description' => 'Procesos, pueblos y memorias que forjaron la identidad del desierto.',
                    'cta_url'     => url('/editorial'),
                    'order'       => 1,
                    'is_active'   => true,
                ]);

                CarouselSlide::create([
                    'image_url'   => 'https://images.unsplash.com/photo-1759675739458-6e5a4a60a117?q=80&w=1488&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'title'       => 'Educación y Patrimonio',
                    'description' => 'Prácticas educativas que preservan memoria y cultura regional.',
                    'cta_url'     => url('/educacion'),
                    'order'       => 2,
                    'is_active'   => true,
                ]);

                CarouselSlide::create([
                    'image_url'   => 'https://images.unsplash.com/photo-1759520582331-8b62a819a452?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'title'       => 'Reflexiones y Pensamiento Crítico',
                    'description' => 'Ensayos para debatir el presente desde la historia y la cultura.',
                    'cta_url'     => url('/ciencia'),
                    'order'       => 3,
                    'is_active'   => true,
                ]);

                CarouselSlide::create([
                    'image_url'   => 'https://images.unsplash.com/photo-1519682337058-a94d519337bc?q=80&w=2000&auto=format&fit=crop',
                    'title'       => 'Turismo y Patrimonio',
                    'description' => 'Iniciativas turísticas que valoran y difunden el patrimonio local.',
                    'cta_url'     => url('/ensayos'),
                    'order'       => 4,
                    'is_active'   => true,
                ]);

                // =========================
                // Sections
                // =========================
                Section::create([
                    'title'     => 'Artículos o Ensayos Históricos',
                    'order'     => 1,
                    'is_active' => true,
                ]);

                Section::create([
                    'title'     => 'Artículos o Ensayos Políticos',
                    'order'     => 2,
                    'is_active' => true,
                ]);

                Section::create([
                    'title'     => 'Artículos o Ensayos Educativos',
                    'order'     => 3,
                    'is_active' => true,
                ]);

                Section::create([
                    'title'     => 'Artículos o Ensayos Científicos',
                    'order'     => 4,
                    'is_active' => true,
                ]);

                Section::create([
                    'title'     => 'Reseña de Books',
                    'order'     => 5,
                    'is_active' => true,
                ]);

                // =========================
                // Reviews
                // =========================
                Review::create([
                    'Book_title'   => 'Atacama, memorias del salitre',
                    'author'       => 'M. Pérez',
                    'cover_url'    => 'https://images.unsplash.com/photo-1759588032622-1388cf9505ad?q=80&w=1172&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'excerpt'      => 'Una reseña breve…',
                    'review_url'   => url('/reseñas/memorias-salitre'),
                    'order'        => 1,
                    'is_published' => true,
                ]);

                Review::create([
                    'Book_title'   => 'Atacama, memorias del salitre',
                    'author'       => 'M. Pérez',
                    'cover_url'    => 'https://images.unsplash.com/photo-1756894256833-934a85a42df9?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'excerpt'      => 'Una reseña breve…',
                    'review_url'   => url('/reseñas/memorias-salitre'),
                    'order'        => 2,
                    'is_published' => true,
                ]);
                // =========================
                // Books
                // =========================
                Book::create([
                    'title' => 'Memorias de la Minería Salitrera',
                    'cover' => 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?w=800&q=80',
                    'url'   => url('/Book/memorias-de-la-mineria-salitrera'),
                ]);

                Book::create([
                    'title' => 'Colección de Oralidades Atacameñas',
                    'cover' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800&q=80',
                    'url'   => url('/Book/coleccion-de-oralidades-atacamenas'),
                ]);

                Book::create([
                    'title' => 'Comic: Historia del Salitre',
                    'cover' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=800&q=80',
                    'url'   => url('/Book/historia-del-salitre'),
                ]);
            });

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            // Para ver el error rápidamente al correr -v
            throw $e;
        }
    }
}
