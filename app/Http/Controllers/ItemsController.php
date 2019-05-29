<?php

namespace App\Http\Controllers;

use App\Item;
use App\RecipeItem;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index() {
    	$items = Item::paginate(10);

    	return view('items.index', [
    		'items' => $items,
    	]);
    }

    public function create() {
    	return view('items.create');
    }

    public function store(Request $request) {
    	$data = $request->validate($this->getRules());
    	$name = $data['name'];

    	Item::create([
    		'name' => $name,
    	]);

    	return redirect('/admin/items');
    }

    public function show($id) {
    	$item = Item::findOrFail($id);

    	return view('items.edit', [
    		'item' => $item,
    	]);
    }

    public function update(Request $request, Item $item) {
    	$data = $request->validate($this->getRules());
    	$name = $data['name'];

    	$item->name = $name;
    	$item->save();

    	return redirect('/admin/items');
    }

    public function destroy(Item $item) {
    	$count = RecipeItem::where('item_id', $item->id)->count();

    	if ($count) {
    		return redirect('/admin/items?deleteError=1');
    	}

    	$item->delete();

    	return redirect('/admin/items');
    }

    private function getRules() {
    	return [
    		'name' => 'required|string',
    	];
    }
}
