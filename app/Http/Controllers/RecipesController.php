<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\RecipeItem;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    public function index() {
    	$recipes = Recipe::paginate(10);

    	return view('recipes.index', [
    		'recipes' => $recipes,
    	]);
    }

    public function create() {
    	return view('recipes.create');
    }

    public function store(Request $request) {
    	$data = $request->validate($this->getRulesCreate());
    	$name = $data['name'];

    	$recipe = Recipe::create([
    		'name' => $name,
    	]);

    	return redirect('/admin/recipes/' . $recipe->id);
    }

    public function show($id) {
    	$recipe = Recipe::findOrFail($id);

    	return view('recipes.edit', [
    		'recipe' => $recipe,
    	]);
    }

    public function update(Request $request, Recipe $recipe) {
    	$data = $request->validate($this->getRulesEdit());
    	$name = $data['name'];
    	$content = $data['content'];

    	$recipe->name = $name;
    	$recipe->content = $content;
    	$recipe->save();

    	RecipeItem::where('recipe_id', $recipe->id)->delete();

    	foreach ($data['items'] as $value) {
    		RecipeItem::create([
    			'recipe_id' => $recipe->id,
    			'item_id' => $value,
    		]);
    	}

    	return redirect('/admin/recipes');
    }

    public function destroy(Recipe $recipe) {
    	RecipeItem::where('recipe_id', $recipe->id)->delete();
    	
    	$recipe->delete();

    	return redirect('/admin/recipes');
    }

    private function getRulesCreate() {
        return [
            'name' => 'required|string',
        ];
    }

    private function getRulesEdit() {
        return [
            'name' => 'required|string',
            'items' => 'array|required',
            'items.*' => 'numeric',
            'content' => 'string|nullable',
        ];
    }
}
