<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\Banner\CreateRequest;
use App\Http\Requests\Banner\EditRequest;
use App\Http\Resources\BannerResource;
use App\Http\Controllers\Api\BaseController;

class BannerController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Banner::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Banner
     */
    public function index(Request $request)
    {
        $banners = Banner::with('creater')->pimp()->paginate();
        BannerResource::collection($banners);
        return $this->sendResponse(compact('banners'), "All Record");
    }

    /**
     * Add
     * @group Banner
     */
    public function store(CreateRequest $request)
    {
        $banner = Banner::CreateUpdate(new Banner, $request);
        $banner = new BannerResource($banner);
        return $this->sendResponse(compact('banner'), 'Banner added successfully');
    }

    /**
     * Show
     * @group Banner
     */
    public function show(Banner $banner, Request $request)
    {
        $banner = new BannerResource($banner);
        return $this->sendResponse(compact('banner'), 'Banner listed successfully');
    }

    /**
     * Update
     * @group Banner
     */
    public function update(EditRequest $request, Banner $banner)
    {
        $banner = Banner::createUpdate($banner, $request);
        $banner = new BannerResource($banner);
        return $this->sendResponse(compact('banner'), 'Banner updated successfully');
    }

    /**
     * Delete
     * @group Banner
     */
    public function destroy(Banner $banner, Request $request)
    {
        $banner->delete();
        $banner = new BannerResource($banner);
        return $this->sendResponse(compact('banner'), 'Banner deleted successfully');
    }
}
