<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductAttribute;

class ProductAttributeValue extends Model
{
    //
        protected $table = 'product_attribute_values';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value',
        'display_order'
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}

public function attribute()
{
    return $this->belongsTo(ProductAttribute::class, 'attribute_id');
}

}
