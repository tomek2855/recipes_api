<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'content',
    ];

    public function items()
    {
    	return $this->belongsToMany('App\Item', 'App\RecipeItem');
    }

    public static function getByItemsIds($items) {
    	if (empty($items)) {
    		$items = 'null';
    	} else {
    		$items = implode(', ', $items);
    	}

    	$sql = "
            SELECT
                ri.recipe_id
            FROM
                recipes r
            INNER JOIN
                recipe_items ri ON r.id = ri.recipe_id
            WHERE
                ri.recipe_id NOT IN (
                    SELECT
                        recipe_id
                    FROM
                        recipe_items
                    WHERE
                        item_id NOT IN ($items)
                    GROUP BY
                        recipe_id
                    )
            GROUP BY ri.recipe_id
        ";

        $result = DB::select($sql);

        foreach ($result as &$item) {
            $item = (array) $item;
        }

        $recipes = self::findMany($result);

        return $recipes;
    }

    public static function getWithLackByItemsIds($items, $differenceItems) {
        if (empty($items)) {
            $items = 'null';
        } else {
            $items = implode(', ', $items);
        }

        if (!count($differenceItems)) {
            $differenceItems = null;
        } else {
            $arr = [];

            foreach ($differenceItems as $item) {
                $arr[] = $item->id;
            }

            $differenceItems = implode(', ', $arr);
        }

        $sql = "
    	    SELECT DISTINCT
    	        ri.recipe_id
            FROM
              recipes r
            INNER JOIN
              recipe_items ri on r.id = ri.recipe_id
            WHERE ri.item_id IN ($items)
    	";

        if ($differenceItems) {
            $sql .= " AND r.id NOT IN ($differenceItems)";
        }

        $result = DB::select($sql);

        foreach ($result as &$item) {
            $item = (array) $item;
        }

        $recipes = self::findMany($result);

        return $recipes;
    }
}