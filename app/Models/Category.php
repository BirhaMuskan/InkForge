<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductListing;


class Category extends Model
{
        protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'icon',
        'is_active',
        'display_order',
        'description',
        'meta_title',
        'meta_description'
    ];
    
public function products()
{
    return $this->hasMany(Product::class);
}

public function parent()
{
    return $this->belongsTo(Category::class, 'parent_id');
}

public function children()
{
    return $this->hasMany(Category::class, 'parent_id');
}

public function listings()
{
    return $this->hasManyThrough(
        ProductListing::class,
        Product::class,
        'category_id', // Foreign key on products table
        'product_id',  // Foreign key on product_listings table
        'id',          // Local key on categories
        'id'           // Local key on products
    );
}
}
