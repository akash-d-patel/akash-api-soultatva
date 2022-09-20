<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    /**
     * List
     * @group Blog
     */

    public function list(Request $request)
    {
        $blogs = Blog::with(['creater'])
                     ->where('status','Active')  
                     ->pimp()->paginate();
        $message = "All Records";
        BlogResource::collection($blogs);
        return $this->sendResponse(compact('blogs'), $message);
    }

    /**
     * Show
     * @group Blog
     */
    public function show($slug, Request $request)
    {
        $message = 'Blog listed successfully';
        $blogDetails = Blog::where('slug', $slug)->first();
        $blog = new BlogResource($blogDetails);
        return $this->sendResponse(compact('blog'), $message);
    }
}
