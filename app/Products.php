<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ImageProducts::class, 'product_id');
    }

    public function offers()
    {
        return $this->hasMany(Offers::class, 'product_id');
    }
}
