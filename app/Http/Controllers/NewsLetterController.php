<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\NewsLetter\CreateRequest;
use App\Http\Requests\NewsLetter\EditRequest;
use App\Http\Resources\NewsLetterResource;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(NewsLetter::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group NewsLetter
     */
    public function index(Request $request)
    {
        $newsLetters = NewsLetter::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        NewsLetterResource::collection($newsLetters);
        return $this->sendResponse(compact('newsLetters'), $message);
    }

    /**
     * Add
     * @group NewsLetter
     */
    public function store(CreateRequest $request)
    {
        $newsLetter = NewsLetter::createUpdate(new NewsLetter, $request);
        $message = "News Letter added successfully";
        $newsLetter = new NewsLetterResource($newsLetter);
        return $this->sendResponse(compact('newsLetter'), $message);
    }

    /**
     * Show
     * @group NewsLetter
     */
    public function show(NewsLetter $newsLetter)
    {
        $message = 'News Letter listed successfully';
        $newsLetter = new NewsLetterResource($newsLetter);
        return $this->sendResponse(compact('newsLetter'), $message);
    }

    /**
     * Update
     * @group NewsLetter
     */
    public function update(EditRequest $request, NewsLetter $newsLetter)
    {
        $newsLetter = NewsLetter::createUpdate($newsLetter, $request);
        $message = "News letter updated successfully";
        $newsLetter = new NewsLetterResource($newsLetter);
        return $this->sendResponse(compact('newsLetter'), $message);
    }

    /**
     * Delete
     * @group NewsLetter
     */
    public function destroy(NewsLetter $newsLetter)
    {
        $newsLetter->delete();
        $message = "News letter deleted successfully";
        $newsLetter = new NewsLetterResource($newsLetter);
        return $this->sendResponse(compact('newsLetter'), $message);
    }
}
