<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchSynonym extends Model
{
    //
     protected $table = 'search_synonyms';

    public $timestamps = false;

    protected $fillable = [
        'term',
        'synonym'
    ];
}
