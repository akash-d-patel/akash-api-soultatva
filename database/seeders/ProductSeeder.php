<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
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
        \App\Models\Product::factory()->create([
            'client_id' => '1',
            'brand_id' => '1',
            'name' => 'Raw Chia Seeds',
            'slug' => 'raw-chia-seeds',
            'short_description' => '100% Organic,Gluten-free, Vegan-friendly, No chemical preservatives, No Chemical additives, Not genetically engineered and Freshly Packed',
            'country_id' => '1',
            'food_type' => 'veg',
            'created_by' => '1'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '1',
            'brand_id' => '1',
            'name' => 'Cashew Cracked Pepper',
            'slug' => 'cashew-cracked-pepper',
            'short_description' => 'Once a staple of royal Indian cuisine- the beloved Cashew- with its mild and creamy flavour, is a welcome addition to anything and everything.',
            'country_id' => '1',
            'food_type' => 'veg',
            'created_by' => '1'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '1',
            'brand_id' => '1',
            'name' => 'Perky Proteins Combo',
            'slug' => 'perky-proteins-combo',
            'short_description' => 'Eat your proteins right. Our Perky Protein Combo contains organic Flax Seeds, Melon Seeds, and Sunflower Seeds that are high in proteins, Omega-3 and anti-oxidants.',
            'country_id' => '1',
            'food_type' => 'veg',
            'created_by' => '1'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '1',
            'brand_id' => '1',
            'name' => 'Nutty Dates',
            'slug' => 'nutty-dates',
            'short_description' => 'Dates Almonds Cashew Nuts Pistachios Honey',
            'country_id' => '1',
            'food_type' => 'veg',
            'created_by' => '1'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '1',
            'brand_id' => '1',
            'name' => 'Almonds Roasted Salted',
            'slug' => 'almonds-roasted-salted',
            'short_description' => '100% Organic,Gluten-free, Vegan-friendly, No chemical preservatives and Freshly Packed',
            'country_id' => '1',
            'food_type' => 'veg',
            'created_by' => '1'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '1',
            'brand_id' => '1',
            'name' => 'Pistachios Roasted Salted',
            'slug' => 'pistachios-roasted-salted',
            'short_description' => 'The sweet and savoury flavour of Pistachios makes for a mouth-watering addition to trail mix',
            'country_id' => '1',
            'food_type' => 'veg',
            'created_by' => '1'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '1',
            'brand_id' => '1',
            'name' => 'Melon Seeds Tangy Turmeric',
            'slug' => 'melon-seeds-tangy-turmeric',
            'short_description' => 'Seeds arrive ready in easy to use, BPA-free packaging',
            'country_id' => '1',
            'food_type' => 'veg',
            'created_by' => '1'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '1',
            'brand_id' => '1',
            'name' => 'Seeds Trail Mix',
            'slug' => 'seeds-trail-mix',
            'short_description' => 'An ideal addition to vegetarian, vegan, whole food, paleo, ketogenic, and gluten-free diets.',
            'country_id' => '1',
            'food_type' => 'veg',
            'created_by' => '1'
        ]);


        /*
        * soultatva.com.au
        */
        \App\Models\Product::factory()->create([
            'client_id' => '2',
            'brand_id' => '2',
            'name' => 'Raw Chia Seeds',
            'slug' => 'raw-chia-seeds',
            'short_description' => '100% Organic,Gluten-free, Vegan-friendly, No chemical preservatives, No Chemical additives, Not genetically engineered and Freshly Packed',
            'country_id' => '2',
            'food_type' => 'veg',
            'created_by' => '2'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '2',
            'brand_id' => '2',
            'name' => 'Cashew Cracked Pepper',
            'slug' => 'cashew-cracked-pepper',
            'short_description' => 'Once a staple of royal Indian cuisine- the beloved Cashew- with its mild and creamy flavour, is a welcome addition to anything and everything.',
            'country_id' => '2',
            'food_type' => 'veg',
            'created_by' => '2'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '2',
            'brand_id' => '2',
            'name' => 'Perky Proteins Combo',
            'slug' => 'perky-proteins-combo',
            'short_description' => 'Eat your proteins right. Our Perky Protein Combo contains organic Flax Seeds, Melon Seeds, and Sunflower Seeds that are high in proteins, Omega-3 and anti-oxidants.',
            'country_id' => '2',
            'food_type' => 'veg',
            'created_by' => '2'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '2',
            'brand_id' => '2',
            'name' => 'Nutty Dates',
            'slug' => 'nutty-dates',
            'short_description' => 'Dates Almonds Cashew Nuts Pistachios Honey',
            'country_id' => '2',
            'food_type' => 'veg',
            'created_by' => '2'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '2',
            'brand_id' => '2',
            'name' => 'Almonds Roasted Salted',
            'slug' => 'almonds-roasted-salted',
            'short_description' => '100% Organic,Gluten-free, Vegan-friendly, No chemical preservatives and Freshly Packed',
            'country_id' => '2',
            'food_type' => 'veg',
            'created_by' => '2'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '2',
            'brand_id' => '2',
            'name' => 'Pistachios Roasted Salted',
            'slug' => 'pistachios-roasted-salted',
            'short_description' => 'The sweet and savoury flavour of Pistachios makes for a mouth-watering addition to trail mix',
            'country_id' => '2',
            'food_type' => 'veg',
            'created_by' => '2'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '2',
            'brand_id' => '2',
            'name' => 'Melon Seeds Tangy Turmeric',
            'slug' => 'melon-seeds-tangy-turmeric',
            'short_description' => 'Seeds arrive ready in easy to use, BPA-free packaging',
            'country_id' => '2',
            'food_type' => 'veg',
            'created_by' => '2'
        ]);
        \App\Models\Product::factory()->create([
            'client_id' => '2',
            'brand_id' => '2',
            'name' => 'Seeds Trail Mix',
            'slug' => 'seeds-trail-mix',
            'short_description' => 'An ideal addition to vegetarian, vegan, whole food, paleo, ketogenic, and gluten-free diets.',
            'country_id' => '2',
            'food_type' => 'veg',
            'created_by' => '2'
        ]);
    }
}
