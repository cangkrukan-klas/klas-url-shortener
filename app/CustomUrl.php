<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomUrl extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url_id', 'customurl'
    ];
}
