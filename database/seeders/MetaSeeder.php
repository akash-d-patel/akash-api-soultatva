<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MetaSeeder extends Seeder
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

        \App\Models\Meta::factory()->create([
            'client_id' => '1',
            'meta_title' => 'Buy Organic Seeds, Dry Fruits & Nuts from Soultatva',
            'meta_description' => 'Buy organic seeds, dry fruits & nuts from us. These snacks will provide you High beneficial fiber with organic seeds and organic Nuts. Shop Now!',
            'meta_keywords' => 'Buy Organic Seeds ,Dry Fruits & Organic Nuts',
            'p_domain_verify' => '933048adfb2a6f05ec92a817f73925f8',
            'og_title' => 'Buy Organic Seeds, Dry Fruits & Nuts from Soultatva',
            'og_url' => 'https://www.soultatva.com',
            'og_image' => 'http://www.soultatva.com/images/sharing-logo.png',
            'og_image_secure_url' => 'https://www.soultatva.com/images/sharing-logo.png',
            'og_description' => 'Buy organic seeds, dry fruits & nuts from us. These snacks will provide you High beneficial fiber with organic seeds and organic Nuts. Shop Now!',
            'og_site_name' => 'https://www.soultatva.com',
            'og_type' => 'website',
            'og_price_currency' => 'INR',
            'ahrefs_site_verification' => '9fa5804fab3818a5f5c660de90849ebc6b4a6ee742b06e0f8145dd0c1b2d7f60',
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
            'google_site_verification' => 'Usn-XXVN7gyUi189xlrnlwbAZG15ST7ZWCTBGvM2BLc',
            'twitter_card' => 'Buy Organic Seeds ,Dry Fruits & Organic Nuts',
            'twitter_title' => 'Buy Organic Seeds, Dry Fruits & Nuts from Soultatva',
            'twitter_site' => 'https://www.soultatva.com',
            'twitter_description' => 'Buy organic seeds, dry fruits & nuts from us. These snacks will provide you High beneficial fiber with organic seeds and organic Nuts. Shop Now!',
            'twitter_image' => 'https://www.soultatva.com/front/images/logo/soultatva-logo-website.png',
            'twitter_creator' => '@soultatva',
            'metatable_id' => '1',
            'metatable_type' => 'App\Models\Page',
            'created_by' => '1'
        ]);

        \App\Models\Meta::factory()->create([
            'client_id' => '1',
            'meta_title' => 'Soultatva - Best Recipes',
            'meta_description' => 'The key to a never-ending youthful zeal, super foods make sure that with each bite and morsel, your soul and body feel good as your gustatory senses.',
            'meta_keywords' => 'soultatva, recipes',
            'p_domain_verify' => '933048adfb2a6f05ec92a817f73925f8',
            'og_title' => 'Soultatva - Best Recipes',
            'og_url' => 'https://www.soultatva.com/recipes',
            'og_image' => 'http://www.soultatva.com/images/sharing-logo.png',
            'og_image_secure_url' => 'https://www.soultatva.com/images/sharing-logo.png',
            'og_description' => 'The key to a never-ending youthful zeal, super foods make sure that with each bite and morsel, your soul and body feel good as your gustatory senses.',
            'og_site_name' => 'https://www.soultatva.com/recipes',
            'og_type' => 'website',
            'og_price_currency' => 'INR',
            'ahrefs_site_verification' => '9fa5804fab3818a5f5c660de90849ebc6b4a6ee742b06e0f8145dd0c1b2d7f60',
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
            'google_site_verification' => 'Usn-XXVN7gyUi189xlrnlwbAZG15ST7ZWCTBGvM2BLc',
            'twitter_card' => 'soultatva, recipes',
            'twitter_title' => 'Soultatva - Best Recipes',
            'twitter_site' => 'https://www.soultatva.com/recipes',
            'twitter_description' => 'The key to a never-ending youthful zeal, super foods make sure that with each bite and morsel, your soul and body feel good as your gustatory senses.',
            'twitter_image' => 'https://www.soultatva.com/front/images/logo/soultatva-logo-website.png',
            'twitter_creator' => '@soultatva',
            'metatable_id' => '2',
            'metatable_type' => 'App\Models\Page',
            'created_by' => '1'
        ]);


        \App\Models\Meta::factory()->create([
            'client_id' => '1',
            'meta_title' => 'Geat Healthy Information To Soultatva Blogs',
            'meta_description' => 'Find out all you need to know about seeds and nuts. Learn about their nutritional benefits and how they can be used in cooking. the right type for your diet.',
            'meta_keywords' => 'soultatva, blogs',
            'p_domain_verify' => '933048adfb2a6f05ec92a817f73925f8',
            'og_title' => 'Geat Healthy Information To Soultatva Blogs',
            'og_url' => 'https://www.soultatva.com/blogs',
            'og_image' => 'http://www.soultatva.com/images/sharing-logo.png',
            'og_image_secure_url' => 'https://www.soultatva.com/images/sharing-logo.png',
            'og_description' => 'Find out all you need to know about seeds and nuts. Learn about their nutritional benefits and how they can be used in cooking. the right type for your diet.',
            'og_site_name' => 'https://www.soultatva.com/blogs',
            'og_type' => 'website',
            'og_price_currency' => 'INR',
            'ahrefs_site_verification' => '9fa5804fab3818a5f5c660de90849ebc6b4a6ee742b06e0f8145dd0c1b2d7f60',
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
            'google_site_verification' => 'Usn-XXVN7gyUi189xlrnlwbAZG15ST7ZWCTBGvM2BLc',
            'twitter_card' => 'soultatva, blogs',
            'twitter_title' => 'Geat Healthy Information To Soultatva Blogs',
            'twitter_site' => 'https://www.soultatva.com/blogs',
            'twitter_description' => 'Find out all you need to know about seeds and nuts. Learn about their nutritional benefits and how they can be used in cooking. the right type for your diet.',
            'twitter_image' => 'https://www.soultatva.com/front/images/logo/soultatva-logo-website.png',
            'twitter_creator' => '@soultatva',
            'metatable_id' => '3',
            'metatable_type' => 'App\Models\Page',
            'created_by' => '1'
        ]);

        \App\Models\Meta::factory()->create([
            'client_id' => '1',
            'meta_title' => 'Go organic products in India. Know About Soultatva',
            'meta_description' => 'Organic products are made from natural ingredients that are rich in antioxidants. Get your organic products from Soultatva.com. Excellent quality products.',
            'meta_keywords' => 'Buy Organic Seeds ,Dry Fruits & Organic Nuts',
            'p_domain_verify' => '933048adfb2a6f05ec92a817f73925f8',
            'og_title' => 'Go organic products in India. Know About Soultatva',
            'og_url' => 'https://www.soultatva.com/our-story',
            'og_image' => 'http://www.soultatva.com/images/sharing-logo.png',
            'og_image_secure_url' => 'https://www.soultatva.com/images/sharing-logo.png',
            'og_description' => 'Organic products are made from natural ingredients that are rich in antioxidants. Get your organic products from Soultatva.com. Excellent quality products.',
            'og_site_name' => 'https://www.soultatva.com/our-story',
            'og_type' => 'website',
            'og_price_currency' => 'INR',
            'ahrefs_site_verification' => '9fa5804fab3818a5f5c660de90849ebc6b4a6ee742b06e0f8145dd0c1b2d7f60',
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
            'google_site_verification' => 'Usn-XXVN7gyUi189xlrnlwbAZG15ST7ZWCTBGvM2BLc',
            'twitter_card' => 'Buy Organic Seeds ,Dry Fruits & Organic Nuts',
            'twitter_title' => 'Go organic products in India. Know About Soultatva',
            'twitter_site' => 'https://www.soultatva.com/our-story',
            'twitter_description' => 'Organic products are made from natural ingredients that are rich in antioxidants. Get your organic products from Soultatva.com. Excellent quality products.',
            'twitter_image' => 'https://www.soultatva.com/front/images/logo/soultatva-logo-website.png',
            'twitter_creator' => '@soultatva',
            'metatable_id' => '4',
            'metatable_type' => 'App\Models\Page',
            'created_by' => '1'
        ]);

        /**
         * soultatva.com.au
         */

        \App\Models\Meta::factory()->create([
            'client_id' => '2',
            'meta_title' => 'Buy Organic Seeds, Dry Fruits & Nuts from Soultatva',
            'meta_description' => 'Buy organic seeds, dry fruits & nuts from us. These snacks will provide you High beneficial fiber with organic seeds and organic Nuts. Shop Now!',
            'meta_keywords' => 'Buy Organic Seeds ,Dry Fruits & Organic Nuts',
            'p_domain_verify' => '933048adfb2a6f05ec92a817f73925f8',
            'og_title' => 'Buy Organic Seeds, Dry Fruits & Nuts from Soultatva',
            'og_url' => 'https://www.soultatva.com',
            'og_image' => 'http://www.soultatva.com/images/sharing-logo.png',
            'og_image_secure_url' => 'https://www.soultatva.com/images/sharing-logo.png',
            'og_description' => 'Buy organic seeds, dry fruits & nuts from us. These snacks will provide you High beneficial fiber with organic seeds and organic Nuts. Shop Now!',
            'og_site_name' => 'https://www.soultatva.com',
            'og_type' => 'website',
            'og_price_currency' => 'INR',
            'ahrefs_site_verification' => '9fa5804fab3818a5f5c660de90849ebc6b4a6ee742b06e0f8145dd0c1b2d7f60',
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
            'google_site_verification' => 'Usn-XXVN7gyUi189xlrnlwbAZG15ST7ZWCTBGvM2BLc',
            'twitter_card' => 'Buy Organic Seeds ,Dry Fruits & Organic Nuts',
            'twitter_title' => 'Buy Organic Seeds, Dry Fruits & Nuts from Soultatva',
            'twitter_site' => 'https://www.soultatva.com',
            'twitter_description' => 'Buy organic seeds, dry fruits & nuts from us. These snacks will provide you High beneficial fiber with organic seeds and organic Nuts. Shop Now!',
            'twitter_image' => 'https://www.soultatva.com/front/images/logo/soultatva-logo-website.png',
            'twitter_creator' => '@soultatva',
            'metatable_id' => '5',
            'metatable_type' => 'App\Models\Page',
            'created_by' => '2'
        ]);

        \App\Models\Meta::factory()->create([
            'client_id' => '2',
            'meta_title' => 'Soultatva - Best Recipes',
            'meta_description' => 'The key to a never-ending youthful zeal, super foods make sure that with each bite and morsel, your soul and body feel good as your gustatory senses.',
            'meta_keywords' => 'soultatva, recipes',
            'p_domain_verify' => '933048adfb2a6f05ec92a817f73925f8',
            'og_title' => 'Soultatva - Best Recipes',
            'og_url' => 'https://www.soultatva.com/recipes',
            'og_image' => 'http://www.soultatva.com/images/sharing-logo.png',
            'og_image_secure_url' => 'https://www.soultatva.com/images/sharing-logo.png',
            'og_description' => 'The key to a never-ending youthful zeal, super foods make sure that with each bite and morsel, your soul and body feel good as your gustatory senses.',
            'og_site_name' => 'https://www.soultatva.com/recipes',
            'og_type' => 'website',
            'og_price_currency' => 'INR',
            'ahrefs_site_verification' => '9fa5804fab3818a5f5c660de90849ebc6b4a6ee742b06e0f8145dd0c1b2d7f60',
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
            'google_site_verification' => 'Usn-XXVN7gyUi189xlrnlwbAZG15ST7ZWCTBGvM2BLc',
            'twitter_card' => 'soultatva, recipes',
            'twitter_title' => 'Soultatva - Best Recipes',
            'twitter_site' => 'https://www.soultatva.com/recipes',
            'twitter_description' => 'The key to a never-ending youthful zeal, super foods make sure that with each bite and morsel, your soul and body feel good as your gustatory senses.',
            'twitter_image' => 'https://www.soultatva.com/front/images/logo/soultatva-logo-website.png',
            'twitter_creator' => '@soultatva',
            'metatable_id' => '6',
            'metatable_type' => 'App\Models\Page',
            'created_by' => '2'
        ]);


        \App\Models\Meta::factory()->create([
            'client_id' => '2',
            'meta_title' => 'Geat Healthy Information To Soultatva Blogs',
            'meta_description' => 'Find out all you need to know about seeds and nuts. Learn about their nutritional benefits and how they can be used in cooking. the right type for your diet.',
            'meta_keywords' => 'soultatva, blogs',
            'p_domain_verify' => '933048adfb2a6f05ec92a817f73925f8',
            'og_title' => 'Geat Healthy Information To Soultatva Blogs',
            'og_url' => 'https://www.soultatva.com/blogs',
            'og_image' => 'http://www.soultatva.com/images/sharing-logo.png',
            'og_image_secure_url' => 'https://www.soultatva.com/images/sharing-logo.png',
            'og_description' => 'Find out all you need to know about seeds and nuts. Learn about their nutritional benefits and how they can be used in cooking. the right type for your diet.',
            'og_site_name' => 'https://www.soultatva.com/blogs',
            'og_type' => 'website',
            'og_price_currency' => 'INR',
            'ahrefs_site_verification' => '9fa5804fab3818a5f5c660de90849ebc6b4a6ee742b06e0f8145dd0c1b2d7f60',
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
            'google_site_verification' => 'Usn-XXVN7gyUi189xlrnlwbAZG15ST7ZWCTBGvM2BLc',
            'twitter_card' => 'soultatva, blogs',
            'twitter_title' => 'Geat Healthy Information To Soultatva Blogs',
            'twitter_site' => 'https://www.soultatva.com/blogs',
            'twitter_description' => 'Find out all you need to know about seeds and nuts. Learn about their nutritional benefits and how they can be used in cooking. the right type for your diet.',
            'twitter_image' => 'https://www.soultatva.com/front/images/logo/soultatva-logo-website.png',
            'twitter_creator' => '@soultatva',
            'metatable_id' => '7',
            'metatable_type' => 'App\Models\Page',
            'created_by' => '2'
        ]);

        \App\Models\Meta::factory()->create([
            'client_id' => '2',
            'meta_title' => 'Go organic products in India. Know About Soultatva',
            'meta_description' => 'Organic products are made from natural ingredients that are rich in antioxidants. Get your organic products from Soultatva.com. Excellent quality products.',
            'meta_keywords' => 'Buy Organic Seeds ,Dry Fruits & Organic Nuts',
            'p_domain_verify' => '933048adfb2a6f05ec92a817f73925f8',
            'og_title' => 'Go organic products in India. Know About Soultatva',
            'og_url' => 'https://www.soultatva.com/our-story',
            'og_image' => 'http://www.soultatva.com/images/sharing-logo.png',
            'og_image_secure_url' => 'https://www.soultatva.com/images/sharing-logo.png',
            'og_description' => 'Organic products are made from natural ingredients that are rich in antioxidants. Get your organic products from Soultatva.com. Excellent quality products.',
            'og_site_name' => 'https://www.soultatva.com/our-story',
            'og_type' => 'website',
            'og_price_currency' => 'INR',
            'ahrefs_site_verification' => '9fa5804fab3818a5f5c660de90849ebc6b4a6ee742b06e0f8145dd0c1b2d7f60',
            'robots' => 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large',
            'google_site_verification' => 'Usn-XXVN7gyUi189xlrnlwbAZG15ST7ZWCTBGvM2BLc',
            'twitter_card' => 'Buy Organic Seeds ,Dry Fruits & Organic Nuts',
            'twitter_title' => 'Go organic products in India. Know About Soultatva',
            'twitter_site' => 'https://www.soultatva.com/our-story',
            'twitter_description' => 'Organic products are made from natural ingredients that are rich in antioxidants. Get your organic products from Soultatva.com. Excellent quality products.',
            'twitter_image' => 'https://www.soultatva.com/front/images/logo/soultatva-logo-website.png',
            'twitter_creator' => '@soultatva',
            'metatable_id' => '8',
            'metatable_type' => 'App\Models\Page',
            'created_by' => '2'
        ]);
    }
}
