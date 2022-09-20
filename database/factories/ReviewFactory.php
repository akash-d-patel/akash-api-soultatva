<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->name,
            'content' => $this->faker->text,
            'rate' => $this->faker->numberBetween(0,5),
            'reviewtable_id' => $this->faker->numberBetween(0,20),
            'reviewtable_type' =>\App\Models\Product::class,
            'created_by' => User::all()->random()->id
        ];
    }
}
