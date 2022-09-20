<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Image\CreateRequest;
use App\Http\Resources\ImageResource;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogImageController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Image::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group BlogImage
     */
    public function index(Blog $blog, Request $request)
    {
        $images = Image::whereHas('blog', function ($query) use ($blog) {
            $query->where('id',  $blog->id);
            return $query;
        })->pimp()->paginate();
        ImageResource::collection($images);
        return $this->sendResponse(compact('blog', 'images'), "All Record");
    }

    /**
     * Add
     * @group BlogImage
     */
    public function store(Blog $blog, Image $image, CreateRequest $request)
    {
        $base64String = $request->file_base64;
        /* uniq name create */
        $file_name =  uniqid();

        @list($type, $file_data) = explode(';', $base64String);
        @list(, $file_data) = explode(',', $file_data);
        $file_data = str_replace(' ', '+', $file_data);
        $type = explode(";", explode("/", $base64String)[1])[0];

        /* project image create */
        $path = 'project_images/' . $file_name . '.' . $type;

        /* public path storage */
        Storage::disk('public')->put($path, base64_decode($file_data));
        $file_path = Storage::url('') . $path;
        $data['file_url'] = config('app.url') . $file_path;

        /* file name store in title */
        $request->title = $file_name . '.' . $type;

        /* image url store in path */
        $request->path = config('app.url') . $file_path;

        $image = Image::createUpdateBlog($blog, $image, $request);
        $message = "Image added successfully";
        $image = new ImageResource($image);
        return $this->sendResponse(compact('image'), $message);
    }

    /**
     * Delete
     * @group BlogImage
     */
    public function destroy(Blog $blog, Image $image, Request $request)
    {
        $blog->images()->find($image->id)->delete();
        $message = "Image deleted successfully";
        $image = new ImageResource($image);
        return $this->sendResponse(compact('image'), $message);
    }
}
