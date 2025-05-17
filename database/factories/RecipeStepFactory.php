<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipeStep>
 */
class RecipeStepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ingredients = [
            'Onion', 'Garlic', 'Tomato', 'Carrot', 'Bell Pepper', 'Potato', 'Broccoli', 'Spinach',
            'Mushroom', 'Avocado', 'Cucumber', 'Zucchini', 'Lemon', 'Apple', 'Banana', 'Chicken Breast',
            'Ground Beef', 'Pork Chops', 'Bacon', 'Salmon', 'Shrimp', 'Tofu', 'Eggs', 'Sausage',
            'Turkey', 'Milk', 'Butter', 'Cheddar Cheese', 'Mozzarella', 'Parmesan', 'Yogurt', 'Cream',
            'Sour Cream', 'Rice', 'Pasta', 'Quinoa', 'Bread', 'Oats', 'Flour', 'Cornmeal', 'Salt',
            'Black Pepper', 'Paprika', 'Chili Powder', 'Cumin', 'Turmeric', 'Basil', 'Oregano',
            'Thyme', 'Cinnamon', 'Nutmeg', 'Soy Sauce', 'Ketchup', 'Mustard', 'Mayonnaise', 'Olive Oil',
            'Balsamic Vinegar', 'Apple Cider Vinegar', 'Hot Sauce', 'Honey', 'Peanut Butter', 'Sugar',
            'Brown Sugar', 'Baking Powder', 'Vanilla Extract', 'Chocolate Chips', 'Coconut Milk', 'Lemon Juice',
        ];

        $units = [
            // Metric Units
            'mg', 'g', 'kg', 'ml', 'l', 'cm',
            // US Customary Units
            'oz', 'lb', 'tsp', 'tbsp', 'fl oz', 'cup', 'pt', 'qt', 'gal',
            // Universal / Non-standard
            'pinch', 'dash', 'slice', 'piece', 'clove', 'can', 'package', 'bottle',
        ];

        $author = [
            'author@foodstuff.com','john@foodstuff.com','amy@foodstuff.com','tom@foodstuff.com','steve@foodstuff.com','jane@foodstuff.com','staff@foodstuff.com',
        ];

        return [
            'recipe_id' => '1',
            'step_number' => '1',
            'step_desc' =>
              array_rand(['1/4','2/4','3/4','1/2','1/3','2/3','1','2','3','4','5','6','7','8','9','10'], 1) . " "
            . array_rand($units, 1). " "
            . array_rand($ingredients, 1),
        ];
    }
}
