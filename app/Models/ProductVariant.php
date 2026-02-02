<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductImage;

class ProductVariant extends Model
{
    //
      protected $table = 'product_variants';

    protected $fillable = [
        'product_id',
        'sku',
        'color_name',
        'color_hex',
        'size',
        'weight_grams',
        'stock_count',
        'is_active',
        'additional_cost'
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}

public function images()
{
    return $this->hasMany(ProductImage::class, 'variant_id');
}

}
