<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;

class RecipesApiController extends Controller
{
    public function index(Request $request) {
        $items = (array) $request->get('items');

    	$recipes = Recipe::getByItemsIds($items);

    	$lackRecipes = Recipe::getWithLackByItemsIds($items, $recipes);

        foreach ($recipes as &$recipe) {
            $str = 'Składniki:
';

            foreach ($recipe->items as $item) {
                $str .= $item->name . '
';
            }

            $recipe->content = $str . '
' . $recipe->content;

            unset($recipe->items);
        }
        foreach ($lackRecipes as &$recipe) {
            $recipe->lackItemsCount = 0;

            $str = 'Składniki:
';

            foreach ($recipe->items as $item) {
                if (!in_array($item->id, $items)) {
                    $recipe->lackItemsCount++;
                }

                $str .= $item->name . '
';
            }

            $recipe->content = $str . '
' . $recipe->content;

            unset($recipe->items);
        }

        $response['results'] = $recipes;
        $response['lackRecipes'] = $lackRecipes;

        return response()->json($response);
    }
}
