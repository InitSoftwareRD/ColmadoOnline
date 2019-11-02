<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ImageProducts::class, 'product_id');
    }
}
