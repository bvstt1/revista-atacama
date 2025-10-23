<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarouselSlide;
use App\Models\Section;
use App\Models\Review;

class HomeSeed extends Seeder
{
    public function run(): void
    {
        // Desactivar FK temporalmente
        Schema::disableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Truncar en orden: hijos -> padres
        Review::truncate();
        Section::truncate();
        CarouselSlide::truncate();

        // Reactivar FK
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        Schema::enableForeignKeyConstraints();

        // Ejecutar todo dentro de una transacción
        DB::beginTransaction();

        try {
            Model::unguarded(function () {

                // =========================
                // Carrusel (home)
                // =========================
                $slides = [
                    [
                        'image_url'   => 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?q=80&w=2000&auto=format&fit=crop',
                        'title'       => 'Historia Viva de Atacama',
                        'description' => 'Procesos, pueblos y memorias que forjaron la identidad del desierto.',
                        'cta_url'     => url('/editorial'),
                        'order'       => 1,
                    ],
                    [
                        'image_url'   => 'https://images.unsplash.com/photo-1759675739458-6e5a4a60a117?q=80&w=1488&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                        'title'       => 'Educación y Patrimonio',
                        'description' => 'Prácticas educativas que preservan memoria y cultura regional.',
                        'cta_url'     => url('/educacion'),
                        'order'       => 2,
                    ],
                    [
                        'image_url'   => 'https://images.unsplash.com/photo-1759520582331-8b62a819a452?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                        'title'       => 'Reflexiones y Pensamiento Crítico',
                        'description' => 'Ensayos para debatir el presente desde la historia y la cultura.',
                        'cta_url'     => url('/ciencia'),
                        'order'       => 3,
                    ],
                    [
                        'image_url'   => 'https://images.unsplash.com/photo-1519682337058-a94d519337bc?q=80&w=2000&auto=format&fit=crop',
                        'title'       => 'Turismo y Patrimonio',
                        'description' => 'Iniciativas turísticas que valoran y difunden el patrimonio local.',
                        'cta_url'     => url('/ensayos'),
                        'order'       => 4,
                    ],
                ];

                foreach ($slides as $slide) {
                    CarouselSlide::create(array_merge($slide, ['is_active' => true]));
                }

                // =========================
                // Sections
                // =========================
                $sections = [
                    'Artículos Históricos',
                    'Artículos Políticos',
                    'Artículos Educativos',
                    'Artículos Científicos',
                    'Reseña de Libros',
                ];

                foreach ($sections as $index => $title) {
                    Section::create([
                        'title'     => $title,
                        'order'     => $index + 1,
                        'is_active' => true,
                    ]);
                }
            });

            // Commit si todo sale bien
            DB::commit();

        } catch (\Throwable $e) {
            // Rollback si hay algún error
            DB::rollBack();
            throw $e;
        }
    }
}
