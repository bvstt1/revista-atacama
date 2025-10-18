<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model {

    use HasFactory;

    protected $casts = [
        'publication_date' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'author',
        'description',
        'image_file',
        'pdf_file',
        'publication_date',
        'order',
        'clicks',
        'section_id',
    ];

    public function scopePopular($query)
    {
        return $query->orderByDesc('clicks')->limit(3);
    }    

    public function section()
    {
        return $this->belongsTo(Section::class); 
    }

    public function edition()
    {
        return $this->belongsTo(Edition::class);
    }

}
