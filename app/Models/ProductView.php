<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductListing;
use App\Models\User;

class ProductView extends Model
{
    //
        protected $table = 'product_views';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'listing_id',
        'user_id',
        'ip_address',
        'user_agent'
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}

public function listing()
{
    return $this->belongsTo(ProductListing::class, 'listing_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
