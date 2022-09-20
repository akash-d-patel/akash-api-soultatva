<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Inventory\CreateRequest;
use App\Http\Requests\Inventory\EditRequest;
use App\Http\Resources\InventoryHistoryResource;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Inventory;
use App\Models\InventoryHistory;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class InventoryController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Inventory::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Inventory
     */
    public function index()
    {
        $products = Product::with(['sub_product', 'sub_product.attribute', 'sub_product.inventory.inventory_history'])->pimp()->paginate(10);
        
        ProductResource::collection($products);

        return $this->sendResponse(compact('products'), "All Records");
    }

    /**
     * Add
     * @group Inventory
     */
    public function store(CreateRequest $request, InventoryHistory $inventoryHistory)
    {
        $inventory = Inventory::createUpdate(new Inventory, $request);
        $message = "Sub Product added successfully";
        $inventory = new InventoryResource($inventory);

        $inventoryHistory = InventoryHistory::createUpdate($inventory, $inventoryHistory, $request);
        $inventoryHistory = new InventoryHistoryResource($inventoryHistory);

        return $this->sendResponse(compact('inventory', 'inventoryHistory'), $message);
    }

    /**
     * Show
     * @group Inventory
     */
    public function show(Inventory $inventory)
    {
        $message = 'Inventory listed successfully';
        $inventory = new InventoryResource($inventory);
        return $this->sendResponse(compact('inventory'), $message);
    }

    /**
     * Update
     * @group Inventory
     */
    public function update(EditRequest $request, Inventory $inventory, InventoryHistory $inventoryHistory)
    {
        $inventory = Inventory::createUpdate($inventory, $request);
        $message = "Inventory updated successfully";
        $inventory = new InventoryResource($inventory);

        $inventoryHistory = InventoryHistory::createUpdate($inventory, $inventoryHistory, $request);
        $inventoryHistory = new InventoryHistoryResource($inventoryHistory);

        return $this->sendResponse(compact('inventory', 'inventoryHistory'), $message);
    }

    /**
     * Delete
     * @group Inventory
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        $message = "Inventory deleted successfully";
        $inventory = new InventoryResource($inventory);
        return $this->sendResponse(compact('inventory'), $message);
    }

    /**
     * Inventory screen change the value api
     */
    public function changeKeyValue(Product $product, Request $request, SubProduct $subProduct, Inventory $inventory)
    {
        $subProduct = SubProduct::find($request->sub_product_id);
        
        $product = Product::find($subProduct->product_id);

        $inventory = Inventory::find($request->sub_product_id);

        switch($request->key) {
            case "name" : 
                $product->name = $request->key_value;
                break;
            case "attribute_id" : 
                $subProduct->attribute_id = $request->key_value;
                break;
            case "attribute_value_id" : 
                $subProduct->attribute_value_id= $request->key_value;
                break;
            case "sku_code" : 
                $subProduct->sku_code= $request->key_value;
                break;
            case "asin_code" : 
                $subProduct->asin_code= $request->key_value;
                break;
            case "gtin_code" : 
                $subProduct->gtin_code= $request->key_value;
                break;
            case "hsn_code" : 
                $subProduct->hsn_code= $request->key_value;
                break;
            case "gst" : 
                $subProduct->gst= $request->key_value;
                break;
            case "price" : 
                $subProduct->price= $request->key_value;
                break;
            case "mrp" : 
                $subProduct->mrp= $request->key_value;
                break;
            case "min_stock" :
                $inventory->min_stock= $request->key_value;
                break;
            case "max_stock" :
                $inventory->max_stock= $request->key_value;
                break;
            case "stock" :
                $inventory->stock= $request->key_value;
                break;
            case "status" : 
                $subProduct->status= $request->key_value;
                break;
            default:
            echo "No key found";
        }

        $product = Product::createUpdate($product, $request);

        $subProduct = SubProduct::createUpdate($product, $subProduct, $request);

        $inventory = Inventory::createUpdate($inventory, $request);
 
        return $this->sendResponse(compact('product', 'subProduct', 'inventory'), 'Change the inventory value...');
    }
}
