<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HeaderMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * soultatva.com.in
         */
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'HOME',
            'label' => 'Home',
            'url' => '/',
            'order' => '1',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'true',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'CATEGORIES',
            'label' => 'Categories',
            'url' => '#',
            'order' => '2',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'true',
            'bottom' => 'true',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'RECIPES',
            'label' => 'Recipes',
            'url' => '/recipes',
            'order' => '3',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'true',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'BLOGS',
            'label' => 'Blogs',
            'url' => '/blogs',
            'order' => '4',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'true',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'FAQS',
            'label' => 'Faqs',
            'url' => '/faqs',
            'order' => '5',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'CONTACT US',
            'label' => 'Countact Us',
            'url' => '/contact-us',
            'order' => '6',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'CMS PAGES',
            'label' => 'Quick Links',
            'url' => '#',
            'order' => '1',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'false',
            'bottom' => 'true',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'LEGAL',
            'label' => 'Legal',
            'url' => '#',
            'order' => '7',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'false',
            'bottom' => 'true',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'SIGN IN',
            'label' => 'Sign In',
            'url' => '/sign-in',
            'order' => '8',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'REGISTER',
            'label' => 'Register',
            'url' => '/register',
            'order' => '9',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'MY ACCOUNT',
            'label' => 'My Account',
            'url' => '/my-account',
            'order' => '10',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'yes',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'MY WISHLIST',
            'label' => 'My Wishlist',
            'url' => '/my-wishlist',
            'order' => '11',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'yes',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '1',
            'parent_id' => null,
            'name' => 'SIGN OUT',
            'label' => 'Sign Out',
            'url' => '#',
            'order' => '12',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'yes',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        /**
         * soultatva.com.au
         */
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'HOME',
            'label' => 'Home',
            'url' => '/',
            'order' => '13',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'true',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'CATEGORIES',
            'label' => 'Categories',
            'url' => '#',
            'order' => '14',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'true',
            'bottom' => 'true',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'RECIPES',
            'label' => 'Recipes',
            'url' => '/recipes',
            'order' => '15',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'true',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'BLOGS',
            'label' => 'Blogs',
            'url' => '/blogs',
            'order' => '16',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'true',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'FAQS',
            'label' => 'Faqs',
            'url' => '/faqs',
            'order' => '17',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'CONTACT US',
            'label' => 'Countact Us',
            'url' => '/contact-us',
            'order' => '18',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'CMS PAGES',
            'label' => 'Quick Links',
            'url' => '#',
            'order' => '13',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'false',
            'bottom' => 'true',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'LEGAL',
            'label' => 'Legal',
            'url' => '#',
            'order' => '19',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'false',
            'top' => 'false',
            'bottom' => 'true',
            'left' => 'false',
            'right' => 'false',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'SIGN IN',
            'label' => 'Sign In',
            'url' => '/sign-in',
            'order' => '20',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'REGISTER',
            'label' => 'Register',
            'url' => '/register',
            'order' => '21',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'MY ACCOUNT',
            'label' => 'My Account',
            'url' => '/my-account',
            'order' => '22',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'yes',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'MY WISHLIST',
            'label' => 'My Wishlist',
            'url' => '/my-wishlist',
            'order' => '23',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'yes',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\HeaderMenu::factory()->create([
            'client_id' => '2',
            'parent_id' => null,
            'name' => 'SIGN OUT',
            'label' => 'Sign Out',
            'url' => '#',
            'order' => '24',
            'link_type' => 'internal',
            'link_open_with' => 'current',
            'upper_top' => 'true',
            'top' => 'false',
            'bottom' => 'false',
            'left' => 'false',
            'right' => 'true',
            'is_authentication' => 'yes',
            'status' => 'Active',
            'created_by' => '2'
        ]);
    }
}
