<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductImage extends Model
{
    //
    protected $table = 'product_images';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'variant_id',
        'image_url',
        'image_type',
        'angle',
        'display_order',
        'alt_text'
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}

public function variant()
{
    return $this->belongsTo(ProductVariant::class, 'variant_id');
}

}
