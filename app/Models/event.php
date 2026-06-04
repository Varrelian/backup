<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Membuka semua kolom agar bisa disimpan sekaligus
    protected $guarded = [];

    // Relasi: Satu acara dimiliki oleh satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}