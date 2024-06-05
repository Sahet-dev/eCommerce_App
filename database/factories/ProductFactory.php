<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(),
            'image' => 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcR8BBStMxYp1r2OT1IqO8MhlVz_8xCywRKZe0oPvOyCqAo_9MH_puazw-x7uFNs4_5Um89cqUYrnkT3aQsEwlkkWzpeJt9XydH_fRq_SvN_oUyuKBeC8_cK-4QFjWRqoPon1KRj7g&usqp=CAc',
            'slug' => fake()->imageUrl(),
            'description' => fake()->realText(2000),
            'price' => fake()->numberBetween(100, 1000),
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
