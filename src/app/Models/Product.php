<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','price','description','image_path','seasons'];


    protected $appends = ['image_url'];

    protected $casts = [
    'seasons' => 'array',  // ← ✅ これを追加！
    ];

    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? \Illuminate\Support\Facades\Storage::url($this->image_path)
            : 'https://placehold.co/600x400?text=No+Image';
    }
}