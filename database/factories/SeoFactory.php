<?php

namespace Database\Factories;

use App\Models\Seo;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence,
            'seotable_id' =>$this->faker->numberBetween(0,20),
            'seotable_type' =>\App\Models\Product::class,
            'created_by' => User::all()->random()->id
        ];
    }
}
