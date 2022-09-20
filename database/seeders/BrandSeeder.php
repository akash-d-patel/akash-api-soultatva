<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        * soultatva.com.in
        */
        \App\Models\Brand::factory()->create([
            'client_id' => '1',
            'name' => 'Soultatva',
            'description' => 'Soultatva`s Sunflower seeds keep the stock of organic sunflower seeds rich in vitamin E, magnesium, calcium, and protein ',
            'created_by' => '1'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\Brand::factory()->create([
            'client_id' => '2',
            'name' => 'Soultatva',
            'description' => 'Soultatva`s Sunflower seeds keep the stock of organic sunflower seeds rich in vitamin E, magnesium, calcium, and protein ',
            'created_by' => '2'
        ]);
    }
}
