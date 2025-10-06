<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Efemeride extends Model {
    protected $fillable = ['date','title','description','image_url','order','is_published'];
}
