<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ProductAttributeValue;
use App\Models\ProductListing;
use App\Models\ProductReview;
use App\Models\ProductView;
use App\Models\ProductTag;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'base_price',
        'category_id',
        'is_active',
        'is_featured',
        'is_embroidery_compatible',
        'print_area_width',
        'print_area_height',
        'min_dpi',
        'mockup_template',
        'weight_grams'
    ];

public function category()
{
    return $this->belongsTo(Category::class);
}

public function variants()
{
    return $this->hasMany(ProductVariant::class);
}

public function images()
{
    return $this->hasMany(ProductImage::class);
}

public function attributes()
{
    return $this->hasMany(ProductAttributeValue::class);
}

public function listings()
{
    return $this->hasMany(ProductListing::class);
}

public function reviews()
{
    return $this->hasMany(ProductReview::class);
}

public function views()
{
    return $this->hasMany(ProductView::class);
}

public function tags()
{
    return $this->belongsToMany(
        ProductTag::class,
        'product_tag_assignments',
        'product_id',
        'tag_id'
    );
}

}
