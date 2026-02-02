<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductTag extends Model
{
    //
        protected $table = 'product_tags';

    protected $fillable = [
        'name',
        'slug',
        'type'
    ];

    public function products()
{
    return $this->belongsToMany(
        Product::class,
        'product_tag_assignments',
        'tag_id',
        'product_id'
    );
}

}
