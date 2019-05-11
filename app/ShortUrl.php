<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CustomUrl;

class ShortUrl extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'shorturl'
    ];

    public function custom_url() {
        return $this->hasMany(CustomUrl::class, 'url_id');
    }
}
