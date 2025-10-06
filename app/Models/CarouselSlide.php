<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselSlide extends Model {
    protected $fillable = ['image_url','title','description','cta_text','cta_url','order','is_active'];
}