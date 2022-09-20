<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
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
        \App\Models\AttributeValue::factory()->create([
            'attribute_id' => '1',
            'value' => '20'
        ]);
        \App\Models\AttributeValue::factory()->create([
            'attribute_id' => '1',
            'value' => '100'
        ]);
        \App\Models\AttributeValue::factory()->create([
            'attribute_id' => '1',
            'value' => '200'
        ]);
        \App\Models\AttributeValue::factory()->create([
            'attribute_id' => '1',
            'value' => '500'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\AttributeValue::factory()->create([
            'attribute_id' => '2',
            'value' => '20'
        ]);
        \App\Models\AttributeValue::factory()->create([
            'attribute_id' => '2',
            'value' => '100'
        ]);
        \App\Models\AttributeValue::factory()->create([
            'attribute_id' => '2',
            'value' => '200'
        ]);
        \App\Models\AttributeValue::factory()->create([
            'attribute_id' => '2',
            'value' => '500'
        ]);
    }
}
