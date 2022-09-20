<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'client_id' => Client::all()->random()->id,
                'name' => $this->faker->name,
                'subject' => $this->faker->sentence(2),
                'content' => $this->faker->sentence,
        ];
    }
}
