<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','author','cover','pdf_file','publication_date'];
    
    protected $casts = ['publication_date' => 'date',];
}
