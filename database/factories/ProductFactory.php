<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Client;
use App\Models\User;
use App\Models\Brand;
use App\Models\Country;
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
        return [ 
            // 
        ];
    }
}
