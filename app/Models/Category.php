<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Category;

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
}
