<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecommendedProductSeeder extends Seeder
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
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '1',
            'created_by' => '1'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '2',
            'created_by' => '1'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '6',
            'created_by' => '1'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '5',
            'created_by' => '1'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '3',
            'created_by' => '1'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '4',
            'created_by' => '1'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '9',
            'created_by' => '2'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '10',
            'created_by' => '2'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '14',
            'created_by' => '2'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '13',
            'created_by' => '2'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '11',
            'created_by' => '2'
        ]);
        \App\Models\RecommendedProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '12',
            'created_by' => '2'
        ]);

    }
}
