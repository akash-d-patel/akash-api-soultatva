<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(dirname(__FILE__) . '/states.sql');
        DB::unprepared($sql);

        \App\Models\State::factory()->create([
            'client_id' => '2',
            'country_id' => '2',
            'name' => 'Sydney'
        ]);
        \App\Models\State::factory()->create([
            'client_id' => '2',
            'country_id' => '2',
            'name' => 'Canberra'
        ]);
        \App\Models\State::factory()->create([
            'client_id' => '2',
            'country_id' => '2',
            'name' => 'Melbourne'
        ]);
        \App\Models\State::factory()->create([
            'client_id' => '2',
            'country_id' => '2',
            'name' => 'Perth'
        ]);
    }
}
