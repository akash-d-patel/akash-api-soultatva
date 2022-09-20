<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\OrphanPage\CreateRequest;
use App\Http\Requests\OrphanPage\EditRequest;
use App\Http\Resources\OrphanPageResource;
use App\Models\OrphanPage;
use Illuminate\Http\Request;

class OrphanPageController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(OrphanPage::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group OrphanPage
     */
    public function index()
    {
        $orphanPages = OrphanPage::with('creater')->pimp()->paginate();
        $message = "All Records";
        OrphanPageResource::collection($orphanPages);
        return $this->sendResponse(compact('orphanPages'),$message);
    }

    /**
    * Add
    * @group OrphanPage
    */
    public function store(CreateRequest $request)
    {
        $orphanPage = OrphanPage::addUpdatedOrphanPages(new OrphanPage, $request);
        $message = "OrphanPage added successfully";
        $orphanPage = new OrphanPageResource($orphanPage);
        return $this->sendResponse(compact('orphanPage'),$message);
    }

    /**
     * Show
     * @group Faq
     */
    public function show(OrphanPage $orphanPage)
    {
        $message = "OrphanPage listed successfully";
        $orphanPage = new OrphanPageResource($orphanPage);
        return $this->sendResponse(compact('orphanPage'),$message);
    }

    /**
     * Update
     * @group Faq
     */
    public function update(EditRequest $request, OrphanPage $orphanPage)
    {
        $orphanPage = OrphanPage::addUpdatedOrphanPages($orphanPage, $request);
        $message = "OrphanPage updated successfully";
        $orphanPage = new OrphanPageResource($orphanPage);
        return $this->sendResponse(compact('orphanPage'),$message);
    }

    /**
     * Delete
     * @group Faq
     */
    public function destroy(OrphanPage $orphanPage)
    {
        $orphanPage->delete();
        $message = "OrphanPage deleted successfully";
        $orphanPage = new OrphanPageResource($orphanPage);
        return $this->sendResponse(compact('orphanPage'),$message);
    }
}
