<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function getForApi($name) {
    	$query = self::query()
    		->select(['id', 'name'])
    		->where('name', 'LIKE', '%' . $name . '%');

		return $query->get();
    }
}