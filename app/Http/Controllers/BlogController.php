<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Blog\CreateRequest;
use App\Http\Requests\Blog\EditRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Blog::class);
        $this->getMiddleware();
    }

   /**
     * List
     * @group Blog
     */
    public function index()
    {
        $blogs = Blog::with('creater')->pimp()->paginate();
        $message = "All Records";
        BlogResource::collection($blogs);
        return $this->sendResponse(compact('blogs'),$message);

    }

   /**
    * Add
    * @group Blog
    */
    public function store(CreateRequest $request)
    {
        $blog = Blog::addUpdatedBlogs(new Blog, $request);
        $message = "Blog added successfully";
        $blog = new BlogResource($blog);
        return $this->sendResponse(compact('blog'),$message);
    }

    /**
     * Show
     * @group Blog
     */
    public function show(Blog $blog)
    {
        $message = "Blog listed successfully";
        $blog = new BlogResource($blog);
        return $this->sendResponse(compact('blog'),$message);
    }

    /**
     * Update
     * @group Blog
     */
    public function update(EditRequest $request, Blog $blog)
    {
        $blog = Blog::addUpdatedBlogs($blog, $request);
        $message = "Blog updated successfully";
        $blog = new BlogResource($blog);
        return $this->sendResponse(compact('blog'),$message);
    }

    /**
     * Delete
     * @group Blog
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        $message = "Blog deleted successfully";
        $blog = new BlogResource($blog);
        return $this->sendResponse(compact('blog'),$message);
    }
}
