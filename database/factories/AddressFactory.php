<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by' => User::all()->random()->id,
            'name' => $this->faker->name,
            'mobile_no' => $this->faker->regexify('91[0-9]{10}'),
            'pin_code' => $this->faker->regexify('[0-9]{6}'),
            'addresstable_id' => $this->faker->numberBetween(0, 20),
            'addresstable_type' => \App\Models\User::class,
            'status' => 'Active',
        ];
    }
}
