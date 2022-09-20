<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    /**
     * List
     * @group Page
     */
    public function list(Request $request)
    {
        $pages = Page::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        PageResource::collection($pages);
        return $this->sendResponse(compact('pages'), $message);
    }

    /**
     * Show
     * @group Page
     */
    public function show($slug, Request $request)
    {
        $message = 'Page listed successfully';
        $pageDetails = Page::where('slug', $slug)->first();
        $page = new PageResource($pageDetails);
        return $this->sendResponse(compact('page'), $message);
    }
}
