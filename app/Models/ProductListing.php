<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\UserDesign;
use App\Models\User;
use App\Models\ProductView;

class ProductListing extends Model
{
    protected $table = 'product_listings';

    protected $fillable = [
        'design_id',
        'product_id',
        'seller_id',
        'price_markup',
        'final_price',
        'is_active',
        'tags',
        'seo_title',
        'seo_description'
    ];

public function product()
{
    return $this->belongsTo(Product::class);
}

public function design()
{
    return $this->belongsTo(UserDesign::class, 'design_id');
}

public function seller()
{
    return $this->belongsTo(User::class, 'seller_id');
}

public function views()
{
    return $this->hasMany(ProductView::class, 'listing_id');
}

}
