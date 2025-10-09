<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model {

    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'pdf_file',
        'section_id',
    ];


    public function section(){
         return $this->belongsTo(Section::class); 
        }
}
