<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\PromoCode\CreateRequest;
use App\Http\Requests\PromoCode\EditRequest;
use App\Http\Resources\PromoCodeResource;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(PromoCode::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group PromoCode
     */
    public function index()
    {
        $promoCodes = PromoCode::with('creater')->pimp()->paginate();
        $message = "All Records";
        PromoCodeResource::collection($promoCodes);
        return $this->sendResponse(compact('promoCodes'),$message);
    }

    /**
     * Add
     * @group PromoCode
     */
    public function store(CreateRequest $request)
    {
        $promoCode = PromoCode::addUpdatedPromoCodes(new PromoCode, $request);
        $message = "promocode added successfully";
        $promoCode = new PromoCodeResource($promoCode);
        return $this->sendResponse(compact('promoCode'),$message);
    }

    /**
     * Show
     * @group PromoCode
     */
    public function show(PromoCode $promoCode)
    {
        $message = "promocode listed successfully";
        $promoCode = new PromoCodeResource($promoCode);
        return $this->sendResponse(compact('promoCode'),$message);
    }

    /**
     * Update
     * @group PromoCode
     */
    public function update(EditRequest $request, PromoCode $promoCode)
    {
        $promoCode = PromoCode::addUpdatedPromoCodes($promoCode,$request);
        $message = "promocode updated successfully";
        $promoCode = new PromoCodeResource($promoCode);
        return $this->sendResponse(compact('promoCode'),$message);
    }

    /**
     * Delete
     * @group PromoCode
     */
    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        $message = "promocode deleted successfully";
        $promoCode = new PromoCodeResource($promoCode);
        return $this->sendResponse(compact('promoCode'),$message);
    }
}
