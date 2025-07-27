<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $fillable = ['name', 'stock', 'price', 'image', 'model', 'year', 'category', 'part_brand', 'description'];
    protected $table = 'spareparts';
}
