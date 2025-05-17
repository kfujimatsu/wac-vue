<?php

namespace Tests\Unit\Controller\Api\V1;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Models\Recipe;
use App\Http\Controllers\Api\V1\RecipeController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RecipeControllerUnitTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_returns_paginated_recipes_without_filters()
    {
        $mockBuilder = Mockery::mock(Builder::class);
        $mockBuilder->shouldReceive('paginate')->with(5)->andReturn('paginated_result');
        $recipeMock = Mockery::mock('alias:' . \App\Models\Recipe::class);
        $recipeMock->shouldReceive('orderBy')->with('slug')->andReturn($mockBuilder);

        app()->instance(\App\Models\Recipe::class, $recipeMock);

        $request = \Illuminate\Http\Request::create('/api/v1/recipes', 'GET');
        app()->bind('request', fn () => $request);

        $controller = new RecipeController();
        $result = $controller->index();

        $this->assertEquals('paginated_result', $result);
    }

    public function test_index_filters_recipes_by_email()
    {
        $keyword = 'test@example.com';

        $mockBuilder = Mockery::mock(Builder::class);
        $mockBuilder->shouldReceive('where')->with('author_email', $keyword)->andReturnSelf();
        $mockBuilder->shouldReceive('paginate')->with(5)->andReturn('filtered_paginated_result');

        $recipeMock = Mockery::mock('alias:' . \App\Models\Recipe::class);
        $recipeMock->shouldReceive('orderBy')->with('slug')->andReturn($mockBuilder);

        app()->instance(\App\Models\Recipe::class, $recipeMock);

        // Simulate request query parameters
        app('request')->replace([
            'selected' => 'Email',
            'keyword' => $keyword,
        ]);

        $controller = new RecipeController();
        $result = $controller->index();

        $this->assertEquals('filtered_paginated_result', $result);
    }

    public function test_show_returns_recipe_by_slug()
    {
        $slug = 'my-recipe';

        // Mock the static where() call and first() chain
        $mockQuery = Mockery::mock(Builder::class);
        $mockQuery->shouldReceive('first')->andReturn('recipe_result');

        $recipeMock = Mockery::mock('alias:' . \App\Models\Recipe::class);
        $recipeMock->shouldReceive('where')->with('slug', $slug)->andReturn($mockQuery);

        app()->instance(\App\Models\Recipe::class, $recipeMock);

        $controller = new RecipeController();
        $result = $controller->show($slug);

        $this->assertEquals('recipe_result', $result);
    }
}
