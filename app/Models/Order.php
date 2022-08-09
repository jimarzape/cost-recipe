<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem', 'orders_id', 'id')->with('recipe');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customers_id', 'id');
    }
}
