<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsSourcesQueryBuilder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->jobTitle,
            'text' => fake()->text,
            'is_private' => false,
            'category_id' => rand(0, (new CategoriesQueryBuilder())->getCategories()->count()),
            'news_source_id' => rand(0, (new NewsSourcesQueryBuilder())->getNewsSources()->count())
        ];
    }
}
