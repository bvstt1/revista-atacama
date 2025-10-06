<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {
    protected $fillable = ['title','order','is_active'];
    public function items(){ return $this->hasMany(SectionItem::class)->orderBy('order'); }
}
