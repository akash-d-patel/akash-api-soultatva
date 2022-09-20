<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
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
        \App\Models\Currency::factory()->create([
            'client_id' => '1',
            'code' => 'INR',
            'name' => 'Rupees',
            'symbol' => '₹'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\Currency::factory()->create([
            'client_id' => '2',
            'code' => 'USD',
            'name' => 'Dollar',
            'symbol' => '$'
        ]);
    }
}
