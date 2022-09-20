<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Soultatva.com.in
         */
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Home',
            'slug' => 'home',
            'description' => '<div class="containwrapper footertoptext">
                <h6>The One-stop Shopping Destination</h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                
                <h6>Where does it come from?</h6>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                
                
                <h6>Why do we use it?</h6>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using "Content here, content here", making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for "lorem ipsum" will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                
                
                <h6>Where can I get some?</h6>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there is not anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                
                </div>',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);

        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Recipes',
            'slug' => 'recipes',
            'description' => 'recipes description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);

        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Blogs',
            'slug' => 'blogs',
            'description' => 'blogs description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);

        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Our Story',
            'slug' => 'our-story',
            'description' => '
                <div class="group clearboth">
                    <div class="aboutbox">
                        <div class="bg2">
                            <div class="aboutboxtext">
                                <h4>Company Overview</h4>
                                <p>Ethereal and divine- super food that titillates your taste buds and leaves a lasting, healthy effect on your body. Soul Tatva is the essence, the beauty and the key to your overall well-being. The finest quality amongst organic and super food, it cleanses your body and rejuvenates your senses.</p>
                                <p>Your health is your most prized possession, the greatest asset of all. With Soul Tatva, every aspect of your well-being is taken care of. With a vast variety of products to choose from, we cater to all your needs when it comes to leading a healthy lifestyle. With us, you eat right and fresh, and live with vigour.</p>
                                <p>We are committed to producing just the best there is to be in your diet, so you could be one with your sagacity. We place products on your platter that please the eye, the tongue, your body, and your soul. Fresh from the farm, rich in nutrients and high on energy, these super foods reinvigorate you, so you can face life with zeal.</p>
                            </div>
                        </div>
                        <div class="imgper"><img src="/images/about-pic1.jpg" alt="" ></div>
                        <div class="aboutboxtext">
                            <h4>Our Vision</h4>
                            <p>To be a trustworthy and innovative leader in providing genuine organic True Wellness products and solutions for conscious, healthy living..</p>
                        </div>
                    </div><div class="aboutbox">
                        <div class="imgper"><img src="/images/about-pic2.jpg" alt="" ></div>
                        <div class="aboutboxtext">
                            <h4>The Soul</h4>
                            <p>The core, the very essence of your existence, your soul defines who you are and what you will be. Your conscience incarnate, it contains your spirit, your sense of self and the divine chaos within you. We, as humans, rely on making our lives meaningful through the goodness in our hearts and the fire in our souls. This fire, the goodness of your soul is nurtured with good eating. It is satiated when it gets the nourishment it deserves. Embrace it, tame it, cherish it- for it defines how we see ourselves, and how we subsequently act. The soul needs to be treated with tender love and care for it to grow, to bloom. A healthy body is your gateway to a healthy soul. We energize your soul, with nourishment unlike any other; food that not just rejuvenates your body, but also your soul.</p>
                        </div>
                        <div class="bg2">
                            <div class="aboutboxtext">
                                <h4>The Tatva</h4>
                                <p>The element that is present in everything. The tatva is the building block of the universe; the fundamental foundation that makes life possible. In our case, it is the true elements of food that satiate your soul and make life feasible. Our products are the best in their league and purge you of all that’s holding you back from being in touch with your chakras. Eating healthy doesn’t mean that you ever have to compromise on the taste again. Every bite will harmonize your being; align your mind and senses.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>',
            'types' => 'cms',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Eternally Pure',
            'slug' => 'eternally-pure',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'cms',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Process',
            'slug' => 'process',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'cms',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Our Pillars',
            'slug' => 'our-pillars',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'cms',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Faqs',
            'slug' => 'faqs',
            'description' => 'faqs description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Terms and Conditions',
            'slug' => 'terms-and-conditions',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'legal',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Payment Policy',
            'slug' => 'payment-policy',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'legal',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'legal',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'description' => 'contact us description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '1',
            'title' => 'Cart',
            'slug' => 'cart',
            'description' => 'cart description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '1'  
        ]);
        
        /**
         * Soultatva.com.au
         */
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Home',
            'slug' => 'home',
            'description' => '<div class="containwrapper footertoptext">
                <h6>The One-stop Shopping Destination</h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                
                <h6>Where does it come from?</h6>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                
                
                <h6>Why do we use it?</h6>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using "Content here, content here", making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for "lorem ipsum" will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                
                
                <h6>Where can I get some?</h6>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there is not anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                
                </div>',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Recipes',
            'slug' => 'recipes',
            'description' => 'recipes description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);

        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Blogs',
            'slug' => 'blogs',
            'description' => 'blogs description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Our Story',
            'slug' => 'our-story',
            'description' => '
                <div class="group clearboth">
                    <div class="aboutbox">
                        <div class="bg2">
                            <div class="aboutboxtext">
                                <h4>Company Overview</h4>
                                <p>Ethereal and divine- super food that titillates your taste buds and leaves a lasting, healthy effect on your body. Soul Tatva is the essence, the beauty and the key to your overall well-being. The finest quality amongst organic and super food, it cleanses your body and rejuvenates your senses.</p>
                                <p>Your health is your most prized possession, the greatest asset of all. With Soul Tatva, every aspect of your well-being is taken care of. With a vast variety of products to choose from, we cater to all your needs when it comes to leading a healthy lifestyle. With us, you eat right and fresh, and live with vigour.</p>
                                <p>We are committed to producing just the best there is to be in your diet, so you could be one with your sagacity. We place products on your platter that please the eye, the tongue, your body, and your soul. Fresh from the farm, rich in nutrients and high on energy, these super foods reinvigorate you, so you can face life with zeal.</p>
                            </div>
                        </div>
                        <div class="imgper"><img src="/images/about-pic1.jpg" alt="" ></div>
                        <div class="aboutboxtext">
                            <h4>Our Vision</h4>
                            <p>To be a trustworthy and innovative leader in providing genuine organic True Wellness products and solutions for conscious, healthy living..</p>
                        </div>
                    </div><div class="aboutbox">
                        <div class="imgper"><img src="/images/about-pic2.jpg" alt="" ></div>
                        <div class="aboutboxtext">
                            <h4>The Soul</h4>
                            <p>The core, the very essence of your existence, your soul defines who you are and what you will be. Your conscience incarnate, it contains your spirit, your sense of self and the divine chaos within you. We, as humans, rely on making our lives meaningful through the goodness in our hearts and the fire in our souls. This fire, the goodness of your soul is nurtured with good eating. It is satiated when it gets the nourishment it deserves. Embrace it, tame it, cherish it- for it defines how we see ourselves, and how we subsequently act. The soul needs to be treated with tender love and care for it to grow, to bloom. A healthy body is your gateway to a healthy soul. We energize your soul, with nourishment unlike any other; food that not just rejuvenates your body, but also your soul.</p>
                        </div>
                        <div class="bg2">
                            <div class="aboutboxtext">
                                <h4>The Tatva</h4>
                                <p>The element that is present in everything. The tatva is the building block of the universe; the fundamental foundation that makes life possible. In our case, it is the true elements of food that satiate your soul and make life feasible. Our products are the best in their league and purge you of all that’s holding you back from being in touch with your chakras. Eating healthy doesn’t mean that you ever have to compromise on the taste again. Every bite will harmonize your being; align your mind and senses.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>',
            'types' => 'cms',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Eternally Pure',
            'slug' => 'eternally-pure',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'cms',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Process',
            'slug' => 'process',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'cms',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Our Pillars',
            'slug' => 'our-pillars',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'cms',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Faqs',
            'slug' => 'faqs',
            'description' => 'faqs description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Terms and Conditions',
            'slug' => 'terms-and-conditions',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'legal',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Payment Policy',
            'slug' => 'payment-policy',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'legal',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'description' => '<div style="text-align:center;">
                                <h4 style="margin:15%;">Coming Soon</h4>
                              </div>',
            'types' => 'legal',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'description' => 'contact us description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
        \App\Models\Page::factory()->create([
            'client_id' => '2',
            'title' => 'Cart',
            'slug' => 'cart',
            'description' => 'cart description',
            'types' => 'dynamic',
            'is_authentication' => 'no',
            'status' => 'Active',
            'created_by' => '2'  
        ]);
    }
}
