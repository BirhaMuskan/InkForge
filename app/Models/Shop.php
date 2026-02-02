<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ProductListing;

class Shop extends Model
{
    //
      protected $table = 'shops';

    protected $fillable = [
        'seller_id',
        'shop_name',
        'shop_slug',
        'banner_url',
        'logo_url',
        'description',
        'contact_email',
        'social_links',
        'seo_title',
        'seo_description',
        'is_active',
        'is_featured'
    ];

public function seller()
{
    return $this->belongsTo(User::class, 'seller_id');
}

public function listings()
{
    return $this->hasMany(ProductListing::class, 'seller_id');
}
}
