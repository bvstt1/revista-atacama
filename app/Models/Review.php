<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    protected $fillable = ['book_title','author','cover_url','excerpt','review_url','order','is_published'];
}
