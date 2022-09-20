<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontSearchController extends BaseController
{
    public function Search(Request $request)
    {
        $data = $request->get('search_txt');
        /**
         * Search multiple words and full text
         */
        $search = preg_split('/\s+/', $data, -1, PREG_SPLIT_NO_EMPTY); 

        $product = new Product;

        $product = $product->with('images','sub_product.images','sub_product.attribute','sub_product.attribute_value');

        /**
         * Searching Logic 
         * */
        $product = $product->where(function($query)  use ($search) {

            foreach ($search as $search_txt) {
                $query->orWhere('name', 'LIKE', '%'. $search_txt . '%');
                $query->orWhereHas('sub_product.attribute', function($query) use($search_txt) {
                    $query->where('name', 'LIKE', '%' . $search_txt . '%');
                });
                $query->orWhereHas('sub_product.attribute_value', function($query) use($search_txt) {
                    $query->where('value', 'LIKE', '%' . $search_txt . '%');
                });
            }
        });

        $product = $product->paginate();

        return $this->sendResponse(compact('product'));
    }
}
