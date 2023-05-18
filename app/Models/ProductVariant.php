<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{

    use HasFactory;

    protected $guarded = ['id'];

    public function size()
    {
        return $this->belongsTo(Size::class); // 1 varian memiliki 1 ukuran
    }

}
