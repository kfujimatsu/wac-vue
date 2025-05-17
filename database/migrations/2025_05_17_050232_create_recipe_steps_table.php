<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Primary: recipe_steps.id
     * Foreign: recipe.id :: recipe_steps.recipe_id
     * Indexed: email, step
     */
    public function up(): void
    {
        Schema::dropIfExists('recipe_steps');
        Schema::create('recipe_steps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('recipe_id');// foreign key
            $table->string('step_number', 10);
            $table->text('step_desc');

            // fk index
            // $table->foreign('recipe_id')->references('id')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_steps');
    }
};
