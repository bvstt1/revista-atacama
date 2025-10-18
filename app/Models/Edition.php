<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'publication_date', 'cover_image', 'description'];

    public function publications()
    {
        return $this->hasMany(Publication::class)
                    ->whereDate('publication_date', $this->publication_date);
    }
}
