<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
        \App\Models\Category::factory()->create([
            'client_id' => '1',
            'name' => 'SEED',
            'slug' => 'buy-online-organic-seeds',
            'description' => 'Soultatva is a platform where you can buy organic seeds online in India. We are providing all kinds of organic seeds for Healthy to ensure better health of our customers.SEEDS',
            'top' => 'true',
            'bottom' => 'true'
        ]);
        \App\Models\Category::factory()->create([
            'client_id' => '1',
            'name' => 'NUT',
            'slug' => 'buy-online-organic-nuts',
            'description' => 'Buy organic nuts online in India which is the key to a healthy life. Reduce inflammation of organic nuts and remain heathy. Our product is also a natural energy booster.',
            'top' => 'true',
            'bottom' => 'true'
        ]);
        \App\Models\Category::factory()->create([
            'client_id' => '1',
            'name' => 'COMBOS',
            'slug' => 'buy-online-organic-seeds-nuts-combo',
            'description' => 'Our different product combos for our customers',
            'top' => 'true',
            'bottom' => 'true'
        ]);
        \App\Models\Category::factory()->create([
            'client_id' => '1',
            'name' => 'SPECIAL PACKS',
            'slug' => 'special-packs',
            'description' => 'Special packaging for corporate gifting & festival gifting',
            'top' => 'true',
            'bottom' => 'true'
        ]);


        /*
        * soultatva.com.au
        */
        \App\Models\Category::factory()->create([
            'client_id' => '2',
            'name' => 'SEED',
            'slug' => 'buy-online-organic-seeds',
            'description' => 'Soultatva is a platform where you can buy organic seeds online in India. We are providing all kinds of organic seeds for Healthy to ensure better health of our customers.SEEDS',
            'top' => 'true',
            'bottom' => 'true'
        ]);
        \App\Models\Category::factory()->create([
            'client_id' => '2',
            'name' => 'NUT',
            'slug' => 'buy-online-organic-nuts',
            'description' => 'Buy organic nuts online in India which is the key to a healthy life. Reduce inflammation of organic nuts and remain heathy. Our product is also a natural energy booster.',
            'top' => 'true',
            'bottom' => 'true'
        ]);
        \App\Models\Category::factory()->create([
            'client_id' => '2',
            'name' => 'COMBOS',
            'slug' => 'buy-online-organic-seeds-nuts-combo',
            'description' => 'Our different product combos for our customers',
            'top' => 'true',
            'bottom' => 'true'
        ]);
        \App\Models\Category::factory()->create([
            'client_id' => '2',
            'name' => 'SPECIAL PACKS',
            'slug' => 'special-packs',
            'description' => 'Special packaging for corporate gifting & festival gifting',
            'top' => 'true',
            'bottom' => 'true'
        ]);
    }
}
