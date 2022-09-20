<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
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
        \App\Models\Recipe::factory()->create([
            'client_id' => '1',
            'title' => 'Espresso walnut brownie',
            'slug' => 'espresso-walnut-brownie',
            'description' => 'Weve created this mix so you can enjoy the best brownie at home. Espresso Walnut Brownies are rich, fudgy, and decadent!',
            'ingredient' => '1 1/2 cups raw walnuts (splits),1 cup raw unsalted almonds (roughly chopped)',
            'method' => 'Place 1 cup walnuts and 1 cup almonds in the food processor and process until finely ground (amounts as original recipe is written // adjust if altering batch size).',
            'approval_status' => 'approved',
            'created_by' => '1'
        ]);
        \App\Models\Recipe::factory()->create([
            'client_id' => '1',
            'title' => 'Broccoli Almond Soup',
            'slug' => 'broccoli-almond-soup',
            'description' => 'Organic foods often have more beneficial nutrients, such as antioxidants, than their conventionally-grown counterparts and people with allergies to foods, chemicals, or preservatives often find their symptoms lessen or go away when they eat only organic foods.',
            'ingredient' => '½ Cup Finely Chopped Broccoli Stalks
            1 Cup Broccoli Florets
            1 Tsp Roasted Almonds
            ¼ Cup Finely Chopped Onions
            1 Tsp Finely Chopped Garlic
            1 Tsp Finely Chopped Celery
            Salt To Taste
            ½ Cup Milk
            1 Tsp Ground Nut Black Peppercorns',
            'method' => 'To make broccoli and almonds soup/ heat 2 cups of water in a deep pan, add the broccoli stalks and cook on a medium flame for 4 to 5 minutes.
            Add the broccoli florets, onion, garlic, celery and salt, mix it well and cook it for 5 minutes, while stirring occasionally.
            Remove from the flame, allow it to cool a little.
            Once slightly cooled, blend with a hand blender till smooth.
            Transfer the prepared broccoli mixture into the same pan, add the milk,mix well and cook on a medium flame for 2 min,while stirring continuously.
            Add the pepper powder, roasted almonds, mix it well and cook on a medium flame for another 1 min and serve it with a good garnishing.',
            'approval_status' => 'approved',
            'created_by' => '1'
        ]);

        /*
        * soultatva.com.au
        */
        \App\Models\Recipe::factory()->create([
            'client_id' => '2',
            'title' => 'Espresso walnut brownie',
            'slug' => 'espresso-walnut-brownie',
            'description' => 'Weve created this mix so you can enjoy the best brownie at home. Espresso Walnut Brownies are rich, fudgy, and decadent!',
            'ingredient' => '1 1/2 cups raw walnuts (splits),1 cup raw unsalted almonds (roughly chopped)',
            'method' => 'Place 1 cup walnuts and 1 cup almonds in the food processor and process until finely ground (amounts as original recipe is written // adjust if altering batch size).',
            'approval_status' => 'approved',
            'created_by' => '2'
        ]);
        \App\Models\Recipe::factory()->create([
            'client_id' => '2',
            'title' => 'Broccoli Almond Soup',
            'slug' => 'broccoli-almond-soup',
            'description' => 'Organic foods often have more beneficial nutrients, such as antioxidants, than their conventionally-grown counterparts and people with allergies to foods, chemicals, or preservatives often find their symptoms lessen or go away when they eat only organic foods.',
            'ingredient' => '½ Cup Finely Chopped Broccoli Stalks
            1 Cup Broccoli Florets
            1 Tsp Roasted Almonds
            ¼ Cup Finely Chopped Onions
            1 Tsp Finely Chopped Garlic
            1 Tsp Finely Chopped Celery
            Salt To Taste
            ½ Cup Milk
            1 Tsp Ground Nut Black Peppercorns',
            'method' => 'To make broccoli and almonds soup/ heat 2 cups of water in a deep pan, add the broccoli stalks and cook on a medium flame for 4 to 5 minutes.
            Add the broccoli florets, onion, garlic, celery and salt, mix it well and cook it for 5 minutes, while stirring occasionally.
            Remove from the flame, allow it to cool a little.
            Once slightly cooled, blend with a hand blender till smooth.
            Transfer the prepared broccoli mixture into the same pan, add the milk,mix well and cook on a medium flame for 2 min,while stirring continuously.
            Add the pepper powder, roasted almonds, mix it well and cook on a medium flame for another 1 min and serve it with a good garnishing.',
            'approval_status' => 'approved',
            'created_by' => '2'
        ]);
    }
}
