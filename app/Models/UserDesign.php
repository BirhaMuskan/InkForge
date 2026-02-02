<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ProductListing;

class UserDesign extends Model
{
       protected $table = 'user_designs';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'design_data',
        'thumbnail',
        'is_public',
        'status'
    ];

public function user()
{
    return $this->belongsTo(User::class);
}

public function listings()
{
    return $this->hasMany(ProductListing::class, 'design_id');
}

}
