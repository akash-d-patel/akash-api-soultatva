<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Client::factory()->create([
            'name' => 'http://www.api-soultatva.com',
            'email' => 'india.soultatva@gmail.com',
            'mobile_no' => '8886642016',
            'gstin' => '24FGHG5X4CF1280'
        ]);
        \App\Models\Client::factory()->create([
            'name' => 'http://www.api-soultatva.com.au',
            'email' => 'australia.soultatva@gmail.com',
            'mobile_no' => '9824721225',
            'gstin' => '24FGHG5X4CF1290'
        ]);
    }
}
