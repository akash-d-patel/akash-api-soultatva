<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
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
        \App\Models\Attribute::factory()->create([
            'client_id' => '1',
            'name' => 'gram',
            'description' => 'gram description',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        /*
        * soultatva.com.au
        */
        \App\Models\Attribute::factory()->create([
            'client_id' => '2',
            'name' => 'gram',
            'description' => 'gram description',
            'status' => 'Active',
            'created_by' => '2'
        ]);
    }
}
