<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends BaseController
{
    /**
     * List
     * @group Faqs
     */
    public function list(Request $request)
    {
        $faqs = Faq::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        FaqResource::collection($faqs);
        return $this->sendResponse(compact('faqs'), $message);
    }
}
