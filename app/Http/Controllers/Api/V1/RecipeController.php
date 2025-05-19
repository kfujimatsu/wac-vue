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
        $recipes = Recipe::orderBy('slug');
        $query = request()->query();

        if(count($query) && array_key_exists('selected', $query)) {
            switch($query['selected']){
                case 'Email':
                    $recipes = $recipes -> where('author_email', $query['keyword']);
                    break;
                case 'Ingredients':
                    $recipes = $recipes -> where('ingredients', 'like', '%'. $query['keyword'] . '%');
                    break;
                case 'Keyword':
                    $recipes = $recipes -> Where('name', 'like', '%'. $query['keyword'] . '%')
                                        -> orWhere('author_email', 'like', '%'. $query['keyword'] . '%')
                                        -> orWhere('description', 'like', '%'. $query['keyword'] . '%')
                                        -> orWhere('ingredients', 'like', '%'. $query['keyword'] . '%')
                                        -> orWhere('recipe_steps', 'like', '%'. $query['keyword'] . '%');
                    break;
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
