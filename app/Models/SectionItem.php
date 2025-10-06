<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionItem extends Model {
    protected $fillable = ['section_id','title','author','url','order'];
    public function section(){ return $this->belongsTo(Section::class); }
}
