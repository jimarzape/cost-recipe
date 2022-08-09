<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe', 'recipe_id', 'id');
    }
}
