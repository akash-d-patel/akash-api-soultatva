<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Website\CreateRequest;
use App\Http\Requests\Website\EditRequest;
use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Website::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Website
     */
    public function index(Request $request)
    {
        $websites = Website::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        WebsiteResource::collection($websites);
        return $this->sendResponse(compact('websites'), $message);
    }

    /**
     * Add
     * @group Website
     */
    public function store(CreateRequest $request)
    {
        $website = Website::createUpdate(new Website, $request);
        $message = "Website added successfully";
        $website = new WebsiteResource($website);
        return $this->sendResponse(compact('website'), $message);
    }

    /**
     * Show
     * @group Website
     */
    public function show(Website $website)
    {
        $message = "Website listed successfully";
        $website = new WebsiteResource($website);
        return $this->sendResponse(compact('website'), $message);
    }

    /**
     * Update
     * @group Website
     */
    public function update(EditRequest $request, Website $website)
    {
        $website = Website::createUpdate($website, $request);
        $message = "Website updated successfully";
        $website = new WebsiteResource($website);
        return $this->sendResponse(compact('website'), $message);
    }

    /**
     * Delete
     * @group Website
     */
    public function destroy(Website $website)
    {
        $website->delete();
        $message = "Website deleted successfully";
        $website = new WebsiteResource($website);
        return $this->sendResponse(compact('website'), $message);
    }
}
