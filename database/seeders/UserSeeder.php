<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'client_id' => '1',
            'name' => 'Admin',
            'email' => 'admin@soultatva.com',
            'mobile_no' => '8886642016'
        ]);
        \App\Models\User::factory()->create([
            'client_id' => '2',
            'name' => 'Client',
            'email' => 'client@soultatva.com',
            'mobile_no' => '9824721225'
        ]);
    }
}
