<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = 'offers';

    public function getBeginAtAttribute($value)
    {
        return Carbon::create($value);
    }

    public function getEndAtAttribute($value)
    {
        return Carbon::create($value);
    }
}
