<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends BaseController
{
    /**
     * List
     * @group Banner
     */

    public function list(Request $request)
    {
        $banners = Banner::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        BannerResource::collection($banners);
        return $this->sendResponse(compact('banners'), $message);
    }

    /**
     * Show
     * @group Banner
     */
    public function show(Banner $banner, Request $request)
    {
        $message = 'Banner listed successfully';
        $banner = new BannerResource($banner);
        return $this->sendResponse(compact('banner'), $message);
    }
}
