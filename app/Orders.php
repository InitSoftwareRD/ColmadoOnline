<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'order_product','order_id', 'product_id')
            ->withPivot('quantity', 'price', 'subtotal');
    }
}
