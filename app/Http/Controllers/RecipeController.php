<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    /**
     * api/v1/recipes/
     * api/v1/recipes?{query}
     * - ingredient
     * - email
     * - keyword
     **/
    public function index()
    {
        
        $recipes = Recipe::leftJoin('recipe_steps', 'recipes.id', '=', 'recipe_steps.recipe_id')
                    ->select('recipes.*', 'recipe_steps.recipe_id', 'recipe_steps.step_number', 'recipe_steps.step_desc');
        $query = request()->query();
        
        if (count($query)) {
            if (array_key_exists('email', $query)) {
                $recipes = $recipes -> where('recipes.author_email', 'like', '%'. $query['email'] . '%');
            }
            if (array_key_exists('ingredient', $query)) {
                $recipes = $recipes -> where('recipes.ingredients', 'like', '%'. $query['ingredient'] . '%');
            }
            if (array_key_exists('keyword', $query)) {
                $recipes = $recipes -> Where('recipes.name', 'like', '%'. $query['keyword'] . '%')
                                    -> orWhere('recipes.description', 'like', '%'. $query['keyword'] . '%')
                                    -> orWhere('recipes.ingredients', 'like', '%'. $query['keyword'] . '%')
                                    -> orWhere('recipe_steps.step_desc', 'like', '%'. $query['keyword'] . '%');
            }
        }

        return $recipes->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * api/v1/recipes/<slug>
     **/
    public function show(string $slug)
    {
        $recipes = Recipe::where('slug', $slug)->first();

        /**
         * 
         * also get recipe_steps and ingredients
         * join so vue can display
         */
        
        return $recipes;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
