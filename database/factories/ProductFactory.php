<?php

namespace Database\Factories;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Product $product) {
            //
        })->afterCreating(function (Product $product) {
            //
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $category = Category::inRandomOrder()->first();

        $age = AttributeValue::where('attribute_id', 1)->inRandomOrder()->first();

        $country = AttributeValue::where('attribute_id', 2)->inRandomOrder()->first();

        $genre = AttributeValue::where('attribute_id', 3)->inRandomOrder()->first();

        $language = AttributeValue::where('attribute_id', 4)->inRandomOrder()->first();

        $isGroup = fake()->boolean(60) ? rand(1, 150) : null;

        $name = fake()->streetName();

        $fullNameTm = $category->product_name_tm . ': ' . $name . ' | '
            . (isset($genre) ? $genre->name_tm . ' ' : ' ')
            . (isset($age) ? $age->name_tm . ' ' : ' ');
        $fullNameEn = $category->product_name_en . ':' . $name . ' | '
            . (isset($genre) ? $genre->name_en . ' ' : ' ')
            . (isset($age) ? $age->name_tm . ' ' : ' ');
        $fullNameRu = $category->product_name_ru . ':' . $name . ' | '
            . (isset($genre) ? $genre->name_ru . ' ' : ' ')
            . (isset($age) ? $age->name_tm . ' ' : ' ');


        return [
            'category_id' => $category->id,
            'age_id' => isset($age) ? $age->id : null,
            'country_id' => isset($country) ? $country->id : null,
            'genre_id' => isset($genre) ? $genre->id : null,
            'language_id' => isset($language) ? $language->id : null,
            'group_id' => $isGroup,
            'name' => $name,
            'full_name_tm' => $fullNameTm,
            'full_name_en' => $fullNameEn,
            'full_name_ru' => $fullNameRu,
            'season' => isset($isGroup) ? rand(0, 6) : null,
            'episode' => isset($isGroup) ? rand(0, 15) : null,
            'time' => fake()->time('H:m:s','3:59:59'),
            'year' => rand(1950, 2023),
            'description' => fake()->text(rand(300, 500)),
            'favorites' => rand(5, 200),
            'viewed' => rand(10, 1000),
            'rating' => fake()->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
        ];
    }
}
