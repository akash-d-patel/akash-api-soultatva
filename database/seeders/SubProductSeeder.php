<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubProductSeeder extends Seeder
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
        \App\Models\SubProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '1',
            'attribute_id' => '1',
            'attribute_value_id' => '1',
            'sku_code' => 'E0001',
            'asin_code' => '10001',
            'gtin_code' => '101',
            'hsn_code' => '20081921',
            'gst' => '11',
            'price' => '490',
            'mrp' => '500',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '2',
            'attribute_id' => '1',
            'attribute_value_id' => '1',
            'sku_code' => 'E0002',
            'asin_code' => '10002',
            'gtin_code' => '102',
            'hsn_code' => '20081922',
            'gst' => '12',
            'price' => '590',
            'mrp' => '600',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '3',
            'attribute_id' => '1',
            'attribute_value_id' => '1',
            'sku_code' => 'E0003',
            'asin_code' => '10003',
            'gtin_code' => '103',
            'hsn_code' => '20081923',
            'gst' => '13',
            'price' => '690',
            'mrp' => '700',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '4',
            'attribute_id' => '1',
            'attribute_value_id' => '1',
            'sku_code' => 'E0004',
            'asin_code' => '10004',
            'gtin_code' => '104',
            'hsn_code' => '20081924',
            'gst' => '14',
            'price' => '790',
            'mrp' => '800',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '5',
            'attribute_id' => '1',
            'attribute_value_id' => '1',
            'sku_code' => 'E0005',
            'asin_code' => '10005',
            'gtin_code' => '105',
            'hsn_code' => '20081925',
            'gst' => '15',
            'price' => '400',
            'mrp' => '420',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '6',
            'attribute_id' => '1',
            'attribute_value_id' => '1',
            'sku_code' => 'E0006',
            'asin_code' => '10006',
            'gtin_code' => '106',
            'hsn_code' => '20081926',
            'gst' => '16',
            'price' => '420',
            'mrp' => '440',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '7',
            'attribute_id' => '1',
            'attribute_value_id' => '1',
            'sku_code' => 'E0007',
            'asin_code' => '10007',
            'gtin_code' => '107',
            'hsn_code' => '20081927',
            'gst' => '17',
            'price' => '580',
            'mrp' => '600',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '1',
            'product_id' => '8',
            'attribute_id' => '1',
            'attribute_value_id' => '1',
            'sku_code' => 'E0008',
            'asin_code' => '10008',
            'gtin_code' => '108',
            'hsn_code' => '20081928',
            'gst' => '18',
            'price' => '500',
            'mrp' => '520',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        /*
        * soultatva.com.au
        */
        \App\Models\SubProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '9',
            'attribute_id' => '2',
            'attribute_value_id' => '5',
            'sku_code' => 'E0001',
            'asin_code' => '10001',
            'gtin_code' => '101',
            'hsn_code' => '20081921',
            'gst' => '11',
            'price' => '490',
            'mrp' => '500',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '10',
            'attribute_id' => '2',
            'attribute_value_id' => '5',
            'sku_code' => 'E0002',
            'asin_code' => '10002',
            'gtin_code' => '102',
            'hsn_code' => '20081922',
            'gst' => '12',
            'price' => '590',
            'mrp' => '600',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '11',
            'attribute_id' => '2',
            'attribute_value_id' => '5',
            'sku_code' => 'E0003',
            'asin_code' => '10003',
            'gtin_code' => '103',
            'hsn_code' => '20081923',
            'gst' => '13',
            'price' => '690',
            'mrp' => '700',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '12',
            'attribute_id' => '2',
            'attribute_value_id' => '5',
            'sku_code' => 'E0004',
            'asin_code' => '10004',
            'gtin_code' => '104',
            'hsn_code' => '20081924',
            'gst' => '14',
            'price' => '790',
            'mrp' => '800',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '13',
            'attribute_id' => '2',
            'attribute_value_id' => '5',
            'sku_code' => 'E0005',
            'asin_code' => '10005',
            'gtin_code' => '105',
            'hsn_code' => '20081925',
            'gst' => '15',
            'price' => '400',
            'mrp' => '420',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '14',
            'attribute_id' => '2',
            'attribute_value_id' => '5',
            'sku_code' => 'E0006',
            'asin_code' => '10006',
            'gtin_code' => '106',
            'hsn_code' => '20081926',
            'gst' => '16',
            'price' => '420',
            'mrp' => '440',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '15',
            'attribute_id' => '2',
            'attribute_value_id' => '5',
            'sku_code' => 'E0007',
            'asin_code' => '10007',
            'gtin_code' => '107',
            'hsn_code' => '20081927',
            'gst' => '17',
            'price' => '580',
            'mrp' => '600',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\SubProduct::factory()->create([
            'client_id' => '2',
            'product_id' => '16',
            'attribute_id' => '2',
            'attribute_value_id' => '5',
            'sku_code' => 'E0008',
            'asin_code' => '10008',
            'gtin_code' => '108',
            'hsn_code' => '20081928',
            'gst' => '18',
            'price' => '500',
            'mrp' => '520',
            'status' => 'Active',
            'created_by' => '2'
        ]);
    }
}
