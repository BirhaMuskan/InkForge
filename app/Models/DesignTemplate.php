<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DesignTemplate extends Model
{
    //
        protected $table = 'design_templates';

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'file_url',
        'file_type',
        'category',
        'tags',
        'is_free',
        'price',
        'uploader_id',
        'is_active'
    ];

    public function uploader()
{
    return $this->belongsTo(User::class, 'uploader_id');
}

}
