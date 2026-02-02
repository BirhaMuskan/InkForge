<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttributeValue;

class ProductAttribute extends Model
{
    //
        protected $table = 'product_attributes';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'filterable',
        'display_order'
    ];
 public function values()
{
    return $this->hasMany(ProductAttributeValue::class, 'attribute_id');
}

}
