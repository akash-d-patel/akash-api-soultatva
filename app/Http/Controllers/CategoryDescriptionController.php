<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Description\CreateRequest;
use App\Http\Requests\Description\EditRequest;
use App\Http\Resources\DescriptionResource;
use App\Models\Category;
use App\Models\Description;
use Illuminate\Http\Request;

class CategoryDescriptionController extends BaseController
{
    /**
     * List
     * @group CategoryDescription
     */
    public function index(Category $category, Request $request)
    {
        $descriptions = Description::whereHas('category', function ($query) use ($category) {
            $query->where('id', $category->id);
            return $query;
        })->pimp()->paginate();
        $message = "All Records";
        DescriptionResource::collection($descriptions);
        return $this->sendResponse(compact('category', 'descriptions'), $message);
    }

    /**
     * Add
     * @group CategoryDescription
     */
    public function store(Category $category, Description $description, CreateRequest $request)
    {
        $description = Description::createUpdateCategory($category, $description, $request);
        $message = "category description added successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);  
    }

    /**
     * Show
     * @group CategoryDescription
     */
    public function show(Category $category, Description $description, Request $request)
    {
        $message = "category description listed successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);
    }

    /**
     * Update
     * @group CategoryDescription
     */
    public function update(Category $category, EditRequest $request, Description $description)
    {
        $description = Description::createUpdateCategory($category,$description, $request);
        $message = "category description updated successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'),$message);
    }

    /**
     * Delete
     * @group CategoryDescription
     */
    public function destroy(Category $category, Description $description, Request $request)
    {
        $description->delete();
        $message = "category description deleted successfully";
        $description = new DescriptionResource($description);
        return $this->sendResponse(compact('description'), $message);
    }
}
