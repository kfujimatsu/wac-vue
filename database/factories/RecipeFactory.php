<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
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
            'name' => array_rand($ingredients, 5),
            'slug' => 'random-slug-here', // todo:: create a unique slug from name
            'description' => 'test description will create seeder',
            'ingredients' => [],
            'recipe_steps' => [],
            'author_email' => array_rand($author, 1),
            'created_at' => time(),
            'updated_at' => time(),
        ];
    }
}