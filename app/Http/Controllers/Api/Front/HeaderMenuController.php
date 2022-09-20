<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\HeaderMenu\MenuRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\HeaderMenu;
use App\Models\Page;
use App\Models\Recipe;
use Illuminate\Http\Request;

class HeaderMenuController extends BaseController
{
    
    function headerMenu(MenuRequest $request)
    {
        $parent_id = Null;
        $menu = [];
        
        $menu_type = $request->menu_type;

        $menu = $this->menu($menu, $parent_id, $menu_type);

        return $this->sendResponse(compact('menu'), "Header menu listing!");
    }

    function menu($menu, $parent_id, $menu_type)
    {
        $headerMenu = HeaderMenu::where('parent_id', $parent_id)
                                    ->where($menu_type,'true')
                                    ->orderBy('order', 'asc')
                                    ->get();
        
        if(!$headerMenu) {
            return [];
        }

        foreach($headerMenu as $menu_details)
        {
            $menuItem = [];
            $menuItem['parent_id'] = $menu_details['parent_id'];
            $menuItem['name'] = $menu_details['name'];
            $menuItem['label'] = $menu_details['label'];
            $menuItem['url'] = $menu_details['url'];
            $menuItem['order'] = $menu_details['order'];
            $menuItem['link_type'] = $menu_details['link_type'];
            $menuItem['link_open_with'] = $menu_details['link_open_with'];
            $menuItem['upper_top'] = $menu_details['upper_top'];
            $menuItem['top'] = $menu_details['top'];
            $menuItem['bottom'] = $menu_details['bottom'];
            $menuItem['left'] = $menu_details['left'];
            $menuItem['right'] = $menu_details['right'];
            $menuItem['is_authentication'] = $menu_details['is_authentication'];

            switch($menu_details['name']) {
                case 'CATEGORIES' : 
                    $menuItem['child'] = $this->category([], null, $menu_type);
                break;

                case 'RECIPES' :
                    $menuItem['child'] = $this->recipe([], null);
                break;

                case 'BLOGS' :
                    $menuItem['child'] = $this->blog([], null);
                break;

                case 'FAQS' :
                    $menuItem['child'] = $this->faq([], null);
                break;

                case 'CONTACT US' :
                    $menuItem['child'] = $this->contactUs([], null);
                break;

                case 'CMS PAGES' :
                    $menuItem['child'] = $this->cmsPage([], null);
                break;

                case 'LEGAL' :
                    $menuItem['child'] = $this->legal([], null);
                break;

                default :
                    $menuItem['child'] = $this->menu([], $menu_details['id'] , $menu_type);
            }
            array_push($menu, $menuItem);
        }
        return $menu; 
    }

    function category($menu, $parent_id, $menu_type)
    {
        $categories = Category::where('parent_id', $parent_id)
                                ->where($menu_type,'true')
                                ->get();

        if(!$categories) {
            return [];
        }
        foreach($categories as $category_details)
        {
            $menuItem = [];
            $categoryConcate = '/categories/';
            $menuItem['name'] = $category_details['name'];
            $menuItem['label'] = $category_details['name'];
            $menuItem['url'] = $categoryConcate . $category_details['slug'];
            $menuItem['link_type'] = $category_details['link_type'];
            $menuItem['link_open_with'] = $category_details['link_open_with'];
            $menuItem['upper_top'] = $category_details['upper_top'];
            $menuItem['top'] = $category_details['top'];
            $menuItem['bottom'] = $category_details['bottom'];
            $menuItem['left'] = $category_details['left'];
            $menuItem['right'] = $category_details['right'];
            $menuItem['is_authentication'] = 'no';

            $categoryProducts = $category_details->categoryProducts;
            $menuItem['child'] = array();
            foreach($categoryProducts as $categoryProduct) {
                $product = $categoryProduct->product;
                $childItem = [];
                $productConcate = '/products/';
                $childItem['name'] = $product->name;
                $childItem['label'] = $product->name;
                $childItem['url'] = $productConcate . $product->slug;
                $childItem['link_type'] = $product->link_type;
                $childItem['link_open_with'] = $product->link_open_with;
                $childItem['upper_top'] = $product->upper_top;
                $childItem['top'] = $product->top;
                $childItem['bottom'] = $product->bottom;
                $childItem['left'] = $product->left;
                $childItem['right'] = $product->right;
                $childItem['is_authentication'] = 'no';

                $subProducts = $product->sub_product;
                $childItem['child'] = array();
                
                foreach($subProducts as $subProduct){
                   
                    $attribute_value = $subProduct->attribute_value;
                    $attribute = $subProduct->attribute;
                    $subProductName = $product->name . ' ' . $attribute_value->value . ' ' . $attribute->name;
                    $subProductLabel = $attribute_value->value . ' ' . $attribute->name;
                    $subProductSlug = $productConcate . $product->slug . '?' . $attribute->name . '=' .$attribute_value->value;
                    $productChildItem = [];
                    $productChildItem['name'] = $subProductName;
                    $productChildItem['label'] = $subProductLabel;
                    $productChildItem['url'] = $subProductSlug;
                    $productChildItem['link_type'] = 'internal';
                    $productChildItem['link_open_with'] = 'current';
                    $productChildItem['upper_top'] = false;
                    $productChildItem['top'] = true;
                    $productChildItem['bottom'] = false;
                    $productChildItem['left'] = false;
                    $productChildItem['right'] = false;
                    $productChildItem['is_authentication'] = 'no';
                    array_push( $childItem['child'], $productChildItem);
                }



                array_push( $menuItem['child'], $childItem);

            }
           

            $menuItem['child'] = $this->category($menuItem['child'], $category_details['id'], $menu_type );
            
            array_push($menu, $menuItem);

        }
        return $menu;

    }

    function recipe($menu)
    {
        $recipes = Recipe::where('approval_status','approved')->get();

        if(!$recipes) {
            return [];
        }

        foreach($recipes as $recipe_details)
        {
            $menuItem = [];
            $menuItem['name'] = $recipe_details['title'];
            $menuItem['label'] = $recipe_details['title'];
            $menuItem['url'] = $recipe_details['slug'];
            $menuItem['link_type'] = 'internal';
            $menuItem['link_open_with'] = 'current';
            $menuItem['upper_top'] = false;
            $menuItem['top'] = true;
            $menuItem['bottom'] = true;
            $menuItem['left'] = false;
            $menuItem['right'] = false;
            $menuItem['is_authentication'] = 'no';

            // array_push($menu, $menuItem);
        }
        return $menu;
    }

    function blog($menu)
    {
        $blogs = Blog::where('status','Active')->get();
        if(!$blogs) {
            return [];
        }

        foreach($blogs as $blog_details)
        {
            $menuItem = [];
            $menuItem['name'] = $blog_details['title'];
            $menuItem['label'] = $blog_details['title'];
            $menuItem['url'] = $blog_details['slug'];
            $menuItem['link_type'] = 'internal';
            $menuItem['link_open_with'] = 'current';
            $menuItem['upper_top'] = false;
            $menuItem['top'] = true;
            $menuItem['bottom'] = true;
            $menuItem['left'] = false;
            $menuItem['right'] = false;
            $menuItem['is_authentication'] = 'no';

            // array_push($menu, $menuItem);

        }
        return $menu;
    }

    function faq($menu)
    {
        $faqs = Faq::where('status', 'Active')->get();
        if(!$faqs) {
            return [];
        }

        foreach($faqs as $faq_details)
        {
            $menuItem = [];
            $menuItem['name'] = $faq_details['title'];
            $menuItem['label'] = $faq_details['title'];
            $menuItem['url'] = $faq_details['slug'];
            $menuItem['link_type'] = 'internal';
            $menuItem['link_open_with'] = 'current';
            $menuItem['upper_top'] = false;
            $menuItem['top'] = false;
            $menuItem['bottom'] = true;
            $menuItem['left'] = false;
            $menuItem['right'] = false;
            $menuItem['is_authentication'] = 'no';

            // array_push($menu, $menuItem);

        }
        return $menu;
    }

    function contactUs($menu)
    {
        $contacts = Contact::where('status', 'Active')->get();
        if(!$contacts) {
            return [];
        }

        foreach($contacts as $contact_details)
        {
            $menuItem = [];
            $menuItem['name'] = $contact_details['title'];
            $menuItem['label'] = $contact_details['title'];
            $menuItem['url'] = $contact_details['slug'];
            $menuItem['link_type'] = 'internal';
            $menuItem['link_open_with'] = 'current';
            $menuItem['upper_top'] = false;
            $menuItem['top'] = false;
            $menuItem['bottom'] = true;
            $menuItem['left'] = false;
            $menuItem['right'] = false;
            $menuItem['is_authentication'] = 'no';

            // array_push($menu, $menuItem);

        }
        return $menu;
    }

    function cmsPage($menu)
    {
        $pages = Page::where('status','Active')
                        ->where('types', 'cms')
                        ->get();

        if(!$pages) {
            return [];
        }

        foreach($pages as $page_details)
        {
            $menuItem = [];
            $menuItem['name'] = $page_details['title'];
            $menuItem['label'] = $page_details['title'];
            $menuItem['url'] = '/pages/' . $page_details['slug'];
            $menuItem['link_type'] = 'internal';
            $menuItem['link_open_with'] = 'current';
            $menuItem['upper_top'] = false;
            $menuItem['top'] = false;
            $menuItem['bottom'] = true;
            $menuItem['left'] = false;
            $menuItem['right'] = false;
            $menuItem['is_authentication'] = $page_details['is_authentication'];

            array_push($menu, $menuItem);

        }
        return $menu;
    }

    function legal($menu)
    {
        $pages = Page::where('status', 'Active')
                        ->where('types', 'legal')
                        ->get();
        if(!$pages) {
            return [];
        }

        foreach($pages as $page_details)
        {
            $menuItem = [];
            $menuItem['name'] = $page_details['title'];
            $menuItem['label'] = $page_details['title'];
            $menuItem['url'] = '/pages/' . $page_details['slug'];
            $menuItem['link_type'] = 'internal';
            $menuItem['link_open_with'] = 'current';
            $menuItem['upper_top'] = false;
            $menuItem['top'] = false;
            $menuItem['bottom'] = true;
            $menuItem['left'] = false;
            $menuItem['right'] = false;
            $menuItem['is_authentication'] = $page_details['is_authentication'];

            array_push($menu, $menuItem);

        }
        return $menu;
    } 
}
