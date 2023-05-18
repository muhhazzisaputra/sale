<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;
    
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class); // 1 product memiliki 1 kategori
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class); // 1 product memiliki banyak gambar
    }

    public function variant()
    {
        return $this->hasMany(ProductVariant::class); // 1 product memiliki banyak ukuran
    }

}
