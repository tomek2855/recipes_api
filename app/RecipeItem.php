<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeItem extends Model
{
    protected $fillable = [
        'recipe_id',
        'item_id',
    ];

    public $timestamps = false;
}