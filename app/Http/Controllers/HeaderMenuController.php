<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\HeaderMenu\CreateRequest;
use App\Http\Requests\HeaderMenu\EditRequest;
use App\Http\Resources\HeaderMenuResource;
use App\Models\HeaderMenu;
use Illuminate\Http\Request;

class HeaderMenuController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(HeaderMenu::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group HeaderMenu
     */
    public function index()
    {
        $headerMenus = HeaderMenu::with('creater')->pimp()->paginate();
        $message = "All Records";
        HeaderMenuResource::collection($headerMenus);
        return $this->sendResponse(compact('headerMenus'), $message);
    }

    /**
     * Add
     * @group HeaderMenu
     */
    public function store(CreateRequest $request)
    {
        $headerMenu = HeaderMenu::createUpdate(new HeaderMenu, $request);
        $message = "Header menu added successfully";
        $headerMenu = new HeaderMenuResource($headerMenu);
        return $this->sendResponse(compact('headerMenu'), $message);
    }

    /**
     * Show
     * @group HeaderMenu
     */
    public function show(HeaderMenu $headerMenu)
    {
        $message = "Header menu listed successfully";
        $headerMenu = new HeaderMenuResource($headerMenu);
        return $this->sendResponse(compact('headerMenu'), $message);
    }

     /**
     * Update
     * @group HeaderMenu
     */
    public function update(EditRequest $request, HeaderMenu $headerMenu)
    {
        $headerMenu = HeaderMenu::createUpdate($headerMenu, $request);
        $message = "Header menu updated successfully";
        $headerMenu = new HeaderMenuResource($headerMenu);
        return $this->sendResponse(compact('headerMenu'), $message);
    }

     /**
     * Delete
     * @group HeaderMenu
     */
    public function destroy(HeaderMenu $headerMenu)
    {
        $headerMenu->delete();
        $message = "Header menu deleted successfully";
        $headerMenu = new HeaderMenuResource($headerMenu);
        return $this->sendResponse(compact('headerMenu'), $message);
    }
    /**
     * Header menu list
     */
    public function getHeaderMenuList(Request $request)
    {
        $headerMenus = HeaderMenu::with('creater')->pimp()->get();
        $message = "All Records";
        HeaderMenuResource::collection($headerMenus);
        return $this->sendResponse(compact('headerMenus'), $message);
    }

}
