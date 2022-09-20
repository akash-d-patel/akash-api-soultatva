<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\NewsLetter\CreateRequest;
use App\Http\Resources\NewsLetterResource;
use App\Models\NewsLetter;

class NewsLetterController extends BaseController
{
    /**
     * Add
     * @group NewsLetter
     */
    public function store(CreateRequest $request)
    {
        $newsLetter = NewsLetter::createUpdate(new NewsLetter, $request);
        $message = "news letter added successfully";
        $newsLetter = new NewsLetterResource($newsLetter);
        return $this->sendResponse(compact('newsLetter'), $message);
    }
}
