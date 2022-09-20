<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
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
        \App\Models\Language::factory()->create([
            "client_id" => '1',
            'name' => 'English',
            'initial' => 'en',
            'class' => 'first'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\Language::factory()->create([
            "client_id" => '2',
            'name' => 'English',
            'initial' => 'en',
            'class' => 'first'
        ]);
    }
}
