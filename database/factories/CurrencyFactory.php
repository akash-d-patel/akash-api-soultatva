<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'code' => $this->faker->regexify('[A-Za-z0-9]{20}'),
                'name' => $this->faker->name,
                'symbol' => $this->faker->word,
        ];
    }
}
