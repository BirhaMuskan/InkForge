<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductListing;

class Wishlist extends Model
{
    //
        protected $table = 'wishlists';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'product_id',
        'listing_id'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}

public function listing()
{
    return $this->belongsTo(ProductListing::class, 'listing_id');
}

}
