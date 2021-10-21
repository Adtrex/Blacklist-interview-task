<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // Grab a random vendor
        $category = Category::orderByRaw('RAND()')->first();

        return [
            'name' => $this->faker->text(10),
            'category_id' => $category->id,
            'amount' => $this->faker->numerify('######')
        ];
    }
}
