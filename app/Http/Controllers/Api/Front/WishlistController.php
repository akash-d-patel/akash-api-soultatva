<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Wishlist::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Wishlist
     */
    public function index()
    {
        $wishlists = Wishlist::pimp()->paginate();
        $message = "All Records";
        WishlistResource::collection($wishlists);
        return $this->sendResponse(compact('wishlists'), $message);
    }

    /**
     * Add
     * @group Wishlist
     */
    public function store(Request $request)
    {
        $wishlist = Wishlist::createUpdate(new Wishlist, $request);
        $message = "Wishlist added successfully";
        $wishlist = new WishlistResource($wishlist);
        return $this->sendResponse(compact('wishlist'), $message);
    }

    /**
     * Delete
     * @group Wishlist
     */
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        $message = "Wishlist deleted successfully";
        $wishlist = new WishlistResource($wishlist);
        return $this->sendResponse(compact('wishlist'), $message);
    }
}
