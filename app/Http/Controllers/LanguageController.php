<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\Language\CreateRequest;
use App\Http\Requests\Language\EditRequest;
use App\Http\Resources\LanguageResource;
use App\Http\Controllers\Api\BaseController;

class LanguageController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Language::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group Language
     */
    public function index(Request $request, Language $language)
    {
        $languages = $language->pimp()->paginate();
        LanguageResource::collection($languages);
        return $this->sendResponse(compact('languages'), "All Record");
    }

    /**
     * Add
     * @group Language
     */
    public function store(CreateRequest $request)
    {
        $language = Language::addUpdate(new Language, $request);
        $message = "Language added successfully";
        $language = new LanguageResource($language);
        return $this->sendResponse(compact('language'), $message);
    }

    /**
     * Show
     * @group Language
     */
    public function show(Language $language, Request $request)
    {
        $message = 'Language listed successfully';
        $language = new LanguageResource($language);
        return $this->sendResponse(compact('language'), $message);
    }

    /**
     * Update
     * @group Language
     */
    public function update(EditRequest $request, Language $language)
    {
        $language = Language::addUpdate($language, $request);
        $message = "Language updated successfully";
        $language = new LanguageResource($language);
        return $this->sendResponse(compact('language'), $message);
    }

    /**
     * Delete
     * @group Language
     */
    public function destroy(Language $language, Request $request)
    {
        $language->delete();
        $message = "Language deleted successfully";
        $language = new LanguageResource($language);
        return $this->sendResponse(compact('language'), $message);
    }
}
