<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** Login Api */
Route::post('login', 'Api\LoginController@login');

/** Register Api */
Route::post('register', 'Api\LoginController@register');

/** Forgot password Api */
Route::post('forgot-password', 'Api\ForgotPasswordController@forgotPassword');

/** Reset password Api */
Route::post('reset-password', 'Api\ForgotPasswordController@resetPassword');

/** Scheduler guzzle Api */
Route::post('email/send', 'EmailTemplateController@send');


/*
*   Fronted Routes
*/

// HeaderMenu 
Route::get('front/menu-list', 'Api\Front\HeaderMenuController@headerMenu');

// Brand 
Route::get('front/brands', 'Api\Front\BrandController@list');
Route::get('front/brands/{brand}', 'Api\Front\BrandController@show');

// Banner 
Route::get('front/banners', 'Api\Front\BannerController@list');
Route::get('front/banners/{banner}', 'Api\Front\BannerController@show');

// Category
Route::get('front/categories', 'Api\Front\CategoryController@list');
Route::get('front/categories/{slug}', 'Api\Front\CategoryController@show');

// Product
Route::get('front/products', 'Api\Front\ProductController@list');
Route::get('front/products/{slug}', 'Api\Front\ProductController@show');

// Recipe
Route::get('front/recipes', 'Api\Front\RecipeController@list');
Route::post('front/recipes', 'Api\Front\RecipeController@store');
Route::get('front/recipes/{slug}', 'Api\Front\RecipeController@show');

/** front add recipe image */
Route::post('front/recipes/{recipe}/images', 'Api\Front\RecipeImageController@store', array("as" => "recipes"));

/** Related recipe */
Route::get('front/recipes/{recipe}/related-recipes', 'Api\Front\RelatedRecipeController@list', array("as" => "recipes"));

// Page 
Route::get('front/pages', 'Api\Front\PageController@list');
Route::get('front/pages/{slug}', 'Api\Front\PageController@show');

// Blog 
Route::get('front/blogs', 'Api\Front\BlogController@list');
Route::get('front/blogs/{slug}', 'Api\Front\BlogController@show');

// Faq 
Route::get('front/faqs', 'Api\Front\FaqController@list');

// Contact
Route::get('front/contact-us', 'Api\Front\ContactController@list');
Route::post('front/contacts', 'Api\Front\ContactController@store');

// News letters
Route::post('front/news-letters', 'Api\Front\NewsLetterController@store');

// Trending Product 
Route::get('front/trending-products', 'Api\Front\TrendingProductController@list');
Route::get('front/trending-products/{trendingProduct}', 'Api\Front\TrendingProductController@show');

// Recommended Product 
Route::get('front/recommended-products', 'Api\Front\RecommendedProductController@list');
Route::get('front/recommended-products/{recommendedProduct}', 'Api\Front\RecommendedProductController@show');

// Featured Product 
Route::get('front/featured-products', 'Api\Front\FeaturedProductController@list');
Route::get('front/featured-products/{featuredProduct}', 'Api\Front\FeaturedProductController@show');

// Category Product 
Route::get('front/category-products', 'Api\Front\CategoryProductController@list');
Route::get('front/category-products/{categoryProduct}', 'Api\Front\CategoryProductController@show');

/** Related product */
Route::get('front/products/{product}/related-products', 'Api\Front\RelatedProductController@list', array("as" => "products"));

/** Search Api */
Route::get('front/search', 'Api\Front\FrontSearchController@search');

/** Transaction api */
Route::resource('front/transactions', 'Api\Front\TransactionController');

/** Order status update api */
Route::get('front/change-order-status/{order}', 'Api\Front\OrderController@orderStatusUpdate');

/** Currency api */
Route::get('front/currency', 'Api\Front\CurrencyController@show');

/** Front Auth api */
Route::group(['middleware' => 'auth:api'], function () {
    
    /** Change password Api */
    Route::post('change-password', 'Api\ChangePasswordController@changePassword');
    /** My order api */
    Route::get('front/my-orders', 'Api\Front\OrderController@myOrder');
    /** Add to cart api */
    Route::post('front/add-to-cart', 'Api\Front\OrderController@addToCart');
    /** Order update api */
    Route::put('front/orders/{order}', 'Api\Front\OrderController@orderUpdate');
    /** Add to cart product remove api */
    Route::delete('front/orders/{order}/order-items/{orderItem}' ,'Api\Front\OrderController@removeCart',array("as" => "orders"));
    /** Badge api */
    Route::get('front/badge', 'Api\Front\OrderController@badge');
    /** Card order */
    Route::get('front/cart-order', 'Api\Front\OrderController@cartOrder');
    /** My order search api */
    Route::get('front/my-order-search', 'Api\Front\OrderController@MyOrderSearch');
    /** My order delete api */
    Route::delete('front/my-order-delete/{order}', 'Api\Front\OrderController@myOrderDelete');
    /** User api */
    Route::get('front/users', 'Api\Front\UserController@list');
    Route::post('front/users', 'Api\Front\UserController@storeUser');
    Route::get('front/users/{user}', 'Api\Front\UserController@showUser');
    Route::put('front/users/{user}', 'Api\Front\UserController@updateUser');
    Route::delete('front/users/{user}', 'Api\Front\UserController@destroyUser');
    /** User address api */
    Route::resource('front/user/{user}/address', 'Api\Front\UserAddressController', array("as" => "users"));
    /** Wishlist api */
    Route::resource('front/wishlists', 'Api\Front\WishlistController');
    /** Country list api*/
    Route::get('front/country-list', 'Api\Front\CountryController@getCountryList');
    /** State list api*/
    Route::get('front/state-list', 'Api\Front\StateController@getStateList');
    /** City list api*/
    Route::get('front/city-list', 'Api\Front\CityController@getCityList');
    /** Product review api */
    Route::post('front/products/{product}/reviews', 'Api\Front\ProductReviewController@storeProductReview', array("as" => "products"));
    Route::put('front/products/{product}/reviews/{review}', 'Api\Front\ProductReviewController@updateProductReview', array("as" => "products"));
    /** Recipe review api */
    Route::post('front/recipes/{recipe}/reviews', 'Api\Front\RecipeReviewController@storeRecipeReview', array("as" => "recipes"));
    Route::put('front/recipes/{recipe}/reviews/{review}', 'Api\Front\RecipeReviewController@updateRecipeReview', array("as" => "recipes"));

});

/*
*   Admin Routes
*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], function () {

    Route::resource('users', UserController::class);
    Route::get('user-list', 'UserController@getUserList');
    Route::post('change-client', 'UserController@changeclient');
    Route::resource('clients', ClientController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('user-roles', UserRoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('role-permissions', RolePermissionController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::get('state-list', 'StateController@getStateList');
    Route::resource('cities', CityController::class);
    Route::get('city-list', 'CityController@getCityList');
    Route::resource('addresses', AddressController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('category-list', 'CategoryController@getCategoryList');
    Route::resource('products', ProductController::class);
    Route::get('product-list', 'ProductController@getProductList');
    Route::resource('languages', LanguageController::class);
    Route::resource('email-templates', EmailTemplateController::class);
    Route::resource('currencies', CurrencyController::class);
    Route::resource('seo', SeoController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('orphan-pages', OrphanPageController::class);
    Route::resource('recipes', RecipeController::class);
    Route::get('recipe-list', 'RecipeController@getProductList');
    Route::resource('contacts', ContactController::class);
    Route::resource('metas', MetaController::class);
    Route::resource('promo-codes', PromoCodeController::class);
    Route::resource('email-template-identifiers', EmailTemplateIdentifierController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('attributes/{attribute}/attribute-value', AttributeValueController::class, array("as" => "attributes"));
    Route::resource('orders', OrderController::class);
    Route::resource('order-addresses', OrderAddressController::class);
    Route::resource('order-items', OrderItemController::class);
    Route::resource('inventories', InventoryController::class);
    Route::resource('inventory-histories', InventoryHistoryController::class);
    Route::resource('pages', PageController::class);
    Route::resource('sub-products', SubProductController::class);
    Route::get('search-products', 'SubProductController@getSubProduct');
    Route::resource('websites', WebsiteController::class);
    Route::resource('sub-products/{subProduct}/sub-product-websites', SubProductWebsiteController::class, array("as" => "subProducts"));
    Route::resource('products/{product}/sub-products', SubProductController::class, array("as" => "products"));
    Route::resource('orders/{order}/order-items', OrderItemController::class, array("as" => "orders"));
    Route::put('products/{product}/change-key-value', 'InventoryController@changeKeyValue', array("as" => "products"));
    Route::resource('schemas', SchemaController::class);
    Route::resource('trending-products', TrendingProductController::class);
    Route::resource('recommended-products', RecommendedProductController::class);
    Route::resource('featured-products', FeaturedProductController::class);
    Route::resource('category-products', CategoryProductController::class);
    Route::resource('recipe-products', RecipeProductController::class);
    Route::resource('news-letters', NewsLetterController::class);

    /** Admin dashboard api */
    Route::get('dashboard-counts', 'AdminDashboardController@dashboardCount');

    /** Related product */
    Route::resource('products/{product}/related-products', RelatedProductController::class, array("as" => "products"));
    
    /** Related recipe */
    Route::resource('recipes/{recipe}/related-recipes', RelatedRecipeController::class, array("as" => "recipes"));

    Route::resource('header-menus', HeaderMenuController::class);
    Route::get('header-menu-list', 'HeaderMenuController@getHeaderMenuList');

    // User Address
    Route::resource('users/{user}/addresses', UserAddressController::class, array("as" => "users"));

    // Images
    Route::resource('banners/{banner}/images', BannerImageController::class, array("as" => "banners"));
    Route::resource('brands/{brand}/images', BrandImageController::class, array("as" => "brands"));
    Route::resource('categories/{category}/images', CategoryImageController::class, array("as" => "categories"));
    Route::resource('products/{product}/images', ProductImageController::class, array("as" => "products"));
    Route::resource('sub-products/{subProduct}/images', SubProductImageController::class, array("as" => "subProducts"));
    Route::resource('recipes/{recipe}/images', RecipeImageController::class, array("as" => "recipes"));
    Route::resource('blogs/{blog}/images', BlogImageController::class, array("as" => "blogs"));

    // Descriptions
    Route::resource('brands/{brand}/descriptions', BrandDescriptionController::class, array("as" => "brands"));
    Route::resource('categories/{category}/descriptions', CategoryDescriptionController::class, array("as" => "categories"));
    Route::resource('products/{product}/descriptions', ProductDescriptionController::class, array("as" => "products"));

    // Reviews
    Route::resource('products/{product}/reviews', ReviewController::class, array("as" => "products"));
    Route::resource('recipes/{recipe}/reviews', RecipeReviewController::class, array("as" => "recipes"));

    // Metas
    Route::resource('brands/{brand}/metas', BrandMetaController::class, array("as" => "brands"));
    Route::resource('sub-products/{subProduct}/metas', SubProductMetaController::class, array("as" => "subProducts"));
    Route::resource('categories/{category}/metas', CategoryMetaController::class, array("as" => "categories"));
    Route::resource('products/{product}/metas', ProductMetaController::class, array("as" => "products"));
    Route::resource('blogs/{blog}/metas', BlogMetaController::class, array("as" => "blogs"));
    Route::resource('faqs/{faq}/metas', FaqMetaController::class, array("as" => "faqs"));
    Route::resource('recipes/{recipe}/metas', RecipeMetaController::class, array("as" => "recipes"));
    Route::resource('pages/{page}/metas', PageMetaController::class, array("as" => "pages"));

    // Schemas
    Route::resource('products/{product}/schemas', ProductSchemaController::class, array("as" => "products"));
    Route::resource('sub-products/{subProduct}/schemas', SubProductSchemaController::class, array("as" => "subProducts"));
    Route::resource('brands/{brand}/schemas', BrandSchemaController::class, array("as" => "brands"));
    Route::resource('categories/{category}/schemas', CategorySchemaController::class, array("as" => "categories"));
    Route::resource('blogs/{blog}/schemas', BlogSchemaController::class, array("as" => "blogs"));
    Route::resource('faqs/{faq}/schemas', FaqSchemaController::class, array("as" => "faqs"));
    Route::resource('recipes/{recipe}/schemas', RecipeSchemaController::class, array("as" => "recipes"));
    Route::resource('pages/{page}/schemas', PageSchemaController::class, array("as" => "pages"));

});
