<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Image\CreateRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubProductImageController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Image::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group SubProductImage
     */
    public function index(SubProduct $subProduct, Request $request)
    {
        $images = Image::whereHas('subProduct', function ($query) use ($subProduct) {
            $query->where('id',  $subProduct->id);
            return $query;
        })->pimp()->paginate();
        ImageResource::collection($images);
        return $this->sendResponse(compact('subProduct', 'images'), "All Record");
    }

    /**
     * Add
     * @group SubProductImage
     */
    public function store(SubProduct $subProduct, Image $image, CreateRequest $request)
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

        $image = Image::createUpdateSubProduct($subProduct, $image, $request);
        $message = "Image added successfully";
        $image = new ImageResource($image);
        return $this->sendResponse(compact('image'), $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Delete
     * @group SubProductImage
     */
    public function destroy(SubProduct $subProduct, Image $image, Request $request)
    {
        $subProduct->images()->find($image->id)->delete();
        $message = "Image deleted successfully";
        $image = new ImageResource($image);
        return $this->sendResponse(compact('image'), $message);
    }
}
