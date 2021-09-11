<?php

namespace Database\Factories;

use App\Models\Product;
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
        $name = $this->faker->text(10);

        return [
            'name'        => $name,
            'category_id' => rand(1,5),
            'description' => $this->faker->text(100),
            'datetime'    => date('Y-m-d h:i:s'),
        ];
    }
}
