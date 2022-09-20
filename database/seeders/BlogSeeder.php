<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
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
        \App\Models\Blog::factory()->create([
            'client_id' => '1',
            'title' => 'Nutrition, Benefits, and How to Eat Watermelon Seeds',
            'slug' => 'nutrition-benefits-and-how-to-eat-watermelon-seeds',
            'short_description' => 'Watermelon seeds are not only edible, but they are also quite tasty. Therefore, we should publicly debunk the myth that healthful foods are bland.',
            'created_by' => '1'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\Blog::factory()->create([
            'client_id' => '2',
            'title' => 'Nutrition, Benefits, and How to Eat Watermelon Seeds',
            'slug' => 'nutrition-benefits-and-how-to-eat-watermelon-seeds',
            'short_description' => 'Watermelon seeds are not only edible, but they are also quite tasty. Therefore, we should publicly debunk the myth that healthful foods are bland.',
            'created_by' => '2'
        ]);
    }
}
