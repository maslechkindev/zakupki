<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    /**
     * Get all of the owning models with images.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
