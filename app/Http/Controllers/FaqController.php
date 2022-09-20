<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;

use App\Http\Requests\Faqs\CreateRequest;
use App\Http\Requests\Faqs\EditRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;

class FaqController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Faq::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Faq
     */
    public function index()
    {
        $faqs = Faq::with('creater')->pimp()->paginate();
        $message = "All Records";
        FaqResource::collection($faqs);
        return $this->sendResponse(compact('faqs'), $message);
    }

    /**
     * Add
     * @group Faq
     */
    public function store(CreateRequest $request)
    {
        $faq = Faq::addUpdatedFaqs(new Faq, $request);
        $message = "Faq added successfully";
        $faq = new FaqResource($faq);
        return $this->sendResponse(compact('faq'), $message);
    }

    /**
     * Show
     * @group Faq
     */
    public function show(Faq $faq)
    {
        $message = "Faq listed successfully";
        $faq = new FaqResource($faq);
        return $this->sendResponse(compact('faq'), $message);
    }

    /**
     * Update
     * @group Faq
     */
    public function update(EditRequest $request, Faq $faq)
    {
        $faq = Faq::addUpdatedFaqs($faq, $request);
        $message = "Faq updated successfully";
        $faq = new FaqResource($faq);
        return $this->sendResponse(compact('faq'), $message);
    }

    /**
     * Delete
     * @group Faq
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        $message = "Faq deleted successfully";
        $faq = new FaqResource($faq);
        return $this->sendResponse(compact('faq'), $message);
    }
}
