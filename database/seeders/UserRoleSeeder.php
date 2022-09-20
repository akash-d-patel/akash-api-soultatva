<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserRole::factory()->create([
            'user_id' => '1',
            'role_id' => '1',
            'created_by' => '1'
        ]);
        \App\Models\UserRole::factory()->create([
            'user_id' => '2',
            'role_id' => '2',
            'created_by' => '2'
        ]);
    }
}
 