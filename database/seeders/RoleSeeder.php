<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::factory()->create([
            'name' => 'admin',
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'client',
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'customer',
        ]);
    }
}
