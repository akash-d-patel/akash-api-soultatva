<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
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
        \App\Models\Inventory::factory()->create([
            'client_id' => '1',
            'sub_product_id' => '1',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '1'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '1',
            'sub_product_id' => '2',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '1'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '1',
            'sub_product_id' => '3',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '1'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '1',
            'sub_product_id' => '4',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '1'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '1',
            'sub_product_id' => '5',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '1'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '1',
            'sub_product_id' => '6',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '1'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '1',
            'sub_product_id' => '7',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '1'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '1',
            'sub_product_id' => '8',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '1'
        ]);
        /*
        * soultatva.com.au
        */
        \App\Models\Inventory::factory()->create([
            'client_id' => '2',
            'sub_product_id' => '9',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '2'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '2',
            'sub_product_id' => '10',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '2'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '2',
            'sub_product_id' => '11',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '2'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '2',
            'sub_product_id' => '12',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '2'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '2',
            'sub_product_id' => '13',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '2'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '2',
            'sub_product_id' => '14',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '2'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '2',
            'sub_product_id' => '15',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '2'
        ]);
        \App\Models\Inventory::factory()->create([
            'client_id' => '2',
            'sub_product_id' => '16',
            'min_stock' => '100',
            'max_stock' => '1000',
            'stock' => '100',
            'created_by' => '2'
        ]);
    }
}
