<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    // Relasi: Satu kategori memiliki banyak acara
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}