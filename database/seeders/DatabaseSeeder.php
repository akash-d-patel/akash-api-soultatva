<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClientSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
            BannerSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            ProductSeeder::class,
            SubProductSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            BlogSeeder::class,
            RecipeSeeder::class,
            InventorySeeder::class,
            PageSeeder::class,
            MetaSeeder::class,
            FeaturedProductSeeder::class,
            RecommendedProductSeeder::class,
            TrendingProductSeeder::class,
            HeaderMenuSeeder::class
        ]);
        Artisan::call("passport:purge");
        Artisan::call("passport:install");
        Artisan::call("telescope:clear");
    }
}
