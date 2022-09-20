<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
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
        \App\Models\Banner::factory()->create([
            'client_id' => '1',
            'name' => 'Home Page Banner',
            'description' => 'home page banner description',
            'constant' => '7mn',
            'created_by' => '1'
        ]);
        \App\Models\Banner::factory()->create([
            'client_id' => '1',
            'name' => 'Image Banner',
            'description' => 'image banner description',
            'constant' => '3X',
            'created_by' => '1'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\Banner::factory()->create([
            'client_id' => '2',
            'name' => 'Home Page Banner',
            'description' => 'home page banner description',
            'constant' => '5mn',
            'created_by' => '2'
        ]);
        \App\Models\Banner::factory()->create([
            'client_id' => '2',
            'name' => 'Image Banner',
            'description' => 'image banner description',
            'constant' => '4X',
            'created_by' => '2'
        ]);
    }
}
