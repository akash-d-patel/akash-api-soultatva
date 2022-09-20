<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\SubProductWebsite\CreateRequest;
use App\Http\Requests\SubProductWebsite\EditRequest;
use App\Http\Resources\SubProductWebsiteResource;
use App\Models\SubProduct;
use App\Models\SubProductWebsite;
use Illuminate\Http\Request;

class SubProductWebsiteController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(SubProductWebsite::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group SubProductWebsite
     */
    public function index(SubProduct $subProduct, Request $request)
    {
        $subProductWebsites = SubProductWebsite::whereHas('subProduct', function ($query) use ($subProduct) {
            $query->where('id', $subProduct->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        SubProductWebsiteResource::collection($subProductWebsites);
        return $this->sendResponse(compact('subProduct', 'subProductWebsites'), $message);
    }

    /**
     * Add
     * @group SubProductWebsite
     */
    public function store(SubProduct $subProduct, SubProductWebsite $subProductWebsite ,CreateRequest $request)
    {
        $subProductWebsite = SubProductWebsite::createUpdate($subProduct, $subProductWebsite, $request);
        $message = "Sub product website added successfully";
        $subProductWebsite = new SubProductWebsiteResource($subProductWebsite);
        return $this->sendResponse(compact('subProductWebsite'), $message);
    }

    /**
     * Show
     * @group SubProductWebsite
     */
    public function show(SubProduct $subProduct, SubProductWebsite $subProductWebsite)
    {
        $message = "Sub product website listed successfully";
        $subProductWebsite = new SubProductWebsiteResource($subProductWebsite);
        return $this->sendResponse(compact('subProductWebsite'), $message);
    }

    /**
     * Update
     * @group SubProductWebsite
     */
    public function update(SubProduct $subProduct, EditRequest $request, SubProductWebsite $subProductWebsite)
    {
        $subProductWebsite = SubProductWebsite::createUpdate($subProduct, $subProductWebsite, $request);
        $message = "Sub product website updated successfully";
        $subProductWebsite = new SubProductWebsiteResource($subProductWebsite);
        return $this->sendResponse(compact('subProductWebsite'), $message);
    }

    /**
     * Delete
     * @group SubProductWebsite
     */
    public function destroy(SubProduct $subProduct, SubProductWebsite $subProductWebsite)
    {
        $subProduct->subProductWebsites()->find($subProductWebsite->id)->delete();
        $message = "Sub Product deleted successfully";
        $subProductWebsite = new SubProductWebsiteResource($subProductWebsite);
        return $this->sendResponse(compact('subProductWebsite'), $message);
    }
}
