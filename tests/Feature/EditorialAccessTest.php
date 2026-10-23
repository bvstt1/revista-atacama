<?php

use App\Models\Section;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('restricts editorial routes to administrators', function () {
    $reader = User::factory()->create(['role' => 'user']);
    $admin = User::factory()->create(['role' => 'admin']);

    $this->get('/publications/create')->assertRedirect('/login');
    $this->actingAs($reader)->get('/publications/create')->assertForbidden();
    $this->actingAs($admin)->get('/publications/create')->assertOk();
});

it('stores a publication cover and pdf on the public disk', function () {
    Storage::fake('public');
    $admin = User::factory()->create(['role' => 'admin']);
    $section = Section::create(['title' => 'Historia', 'order' => 1]);

    $this->actingAs($admin)->post('/publications', [
        'title' => 'Artículo de prueba',
        'section_id' => $section->id,
        'pdf_file' => UploadedFile::fake()->createWithContent('articulo.pdf', '%PDF-1.4 prueba'),
        'image_file' => UploadedFile::fake()->createWithContent('portada.png', base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/l3sAAAAASUVORK5CYII='
        )),
    ])->assertSessionHasNoErrors();

    $publication = \App\Models\Publication::firstOrFail();
    Storage::disk('public')->assertExists($publication->pdf_file);
    Storage::disk('public')->assertExists($publication->image_file);
    $this->get(route('publications.click', $publication))->assertRedirect(
        asset('storage/'.$publication->pdf_file)
    );
});
