<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Efemeride extends Model {
    protected $fillable = ['date','title','author','description','is_published'];
}
