<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
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
        \App\Models\Country::factory()->create([
            'client_id' => '1',
            'name' => 'India',
            'created_by' => '1'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\Country::factory()->create([
            'client_id' => '2',
            'name' => 'Australia',
            'created_by' => '2'
        ]);
    }
}
