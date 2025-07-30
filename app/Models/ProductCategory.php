<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategory extends Model
{
    use HasFactory;

    // Define the table name if it's not automatically detected
    protected $table = 'product_categories';

    // Define the fillable attributes
    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'image',
        'status',
        'slug',
    ];

    // Define the relationship with the Product model
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id'); // 'category_id' is the foreign key in products
    }
}
