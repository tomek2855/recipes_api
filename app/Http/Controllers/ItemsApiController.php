<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemsApiController extends Controller
{
    public function index(Request $request) {
        $name = $request->get('q');

    	$items = Item::getForApi($name);

        foreach ($items as &$item) {
            $item->text = $item->name;
        }

        $response['results'] = $items;

        return response()->json($response);
    }
}
