<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }


}
