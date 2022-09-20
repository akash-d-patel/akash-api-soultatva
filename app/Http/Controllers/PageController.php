<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Page\CreateRequest;
use App\Http\Requests\Page\EditRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;

class PageController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Page::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Page
     */
    public function index()
    {
        $pages = Page::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        PageResource::collection($pages);
        return $this->sendResponse(compact('pages'), $message);
    }


    /**
     * Add
     * @group Page
     */
    public function store(CreateRequest $request)
    {
        $page = Page::createUpdate(new Page, $request);
        $message = "Page added successfully";
        $page = new PageResource($page);
        return $this->sendResponse(compact('page'), $message);
    }

    /**
     * Show
     * @group Page
     */
    public function show(Page $page)
    {
        $message = 'Page listed successfully';
        $page = new PageResource($page);
        return $this->sendResponse(compact('page'), $message);
    }

    /**
     * Update
     * @group Page
     */
    public function update(EditRequest $request, Page $page)
    {
        $page = Page::createUpdate($page, $request);
        $message = "Page updated successfully";
        $page = new PageResource($page);
        return $this->sendResponse(compact('page'), $message);
    }

    /**
     * Delete
     * @group Page
     */
    public function destroy(Page $page)
    {
        $page->delete();
        $message = "Page deleted successfully";
        $page = new PageResource($page);
        return $this->sendResponse(compact('page'), $message);
    }
}
