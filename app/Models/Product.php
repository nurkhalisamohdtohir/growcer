<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'price', 'quantity', 'category_id', 'brand_id', 'status', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function recipes($query)
    {
        return $query->whereNotNull('recipe')->where('recipe', '!=', '')->distinct()->pluck('recipe');
    }
}
