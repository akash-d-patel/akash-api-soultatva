<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Requests\Seo\CreateRequest;
use App\Http\Requests\Seo\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\SeoResource;

class SeoController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Seo::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Seo
     */
    public function index(Request $request)
    {
        $Seo = Seo::with(['creater'])->pimp()->paginate();
        SeoResource::collection($Seo);
        return $this->sendResponse(compact('Seo'), "All Record");
    }

    /**
     * Add
     * @group Seo
     */
    public function store(CreateRequest $request)
    {
        $seo = Seo::addUpdate(new Seo, $request);
        $message = "SEO added successfully";
        $seo = new SeoResource($seo);
        return $this->sendResponse(compact('seo'), $message);
    }

    /**
     * Show
     * @group Seo
     */
    public function show(Seo $seo, Request $request)
    {
        $message = 'SEO listed successfully';
        $seo = new SeoResource($seo);
        return $this->sendResponse(compact('seo'), $message);
    }

    /**
     * Update
     * @group Seo
     */
    public function update(EditRequest $request, Seo $seo)
    {
        $seo = Seo::addUpdate($seo, $request);
        $message = "SEO updated successfully";
        $seo = new SeoResource($seo);
        return $this->sendResponse(compact('seo'), $message);
    }

    /**
     * Delete
     * @group Seo
     */
    public function destroy(Seo $seo, Request $request)
    {
        $seo->delete();
        $message = "SEO deleted successfully";
        $seo = new SeoResource($seo);
        return $this->sendResponse(compact('seo'), $message);
    }
}
