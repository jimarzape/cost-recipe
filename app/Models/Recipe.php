<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use SoftDeletes;

    public function ingredients()
    {
        return $this->hasMany('App\Models\Ingredients', 'recipe_id', 'id');
    }
}
