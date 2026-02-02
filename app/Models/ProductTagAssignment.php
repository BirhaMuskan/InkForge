<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductTag;

class ProductTagAssignment extends Model
{
    //
        protected $table = 'product_tag_assignments';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'tag_id'
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}

public function tag()
{
    return $this->belongsTo(ProductTag::class);
}

}
