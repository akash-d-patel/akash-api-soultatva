<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(dirname(__FILE__) . '/cities.sql');
        DB::unprepared($sql);

        \App\Models\City::factory()->create([
            'client_id' => '2',
            'state_id' => '37',
            'name' => 'Darlington',
        ]);
        \App\Models\City::factory()->create([
            'client_id' => '2',
            'state_id' => '38',
            'name' => 'Belconnen'
        ]);
        \App\Models\City::factory()->create([
            'client_id' => '2',
            'state_id' => '39',
            'name' => 'East Melbourne'
        ]);
        \App\Models\City::factory()->create([
            'client_id' => '2',
            'state_id' => '40',
            'name' => 'Bedford'
        ]);
    }
}
