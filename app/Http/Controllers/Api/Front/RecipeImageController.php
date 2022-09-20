<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Models\Image;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ImageResource;

class RecipeImageController extends BaseController
{
    /**
     * Add
     * @group RecipeImage
     */
    public function store(Recipe $recipe, Image $image, Request $request)
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

        $image = Image::createUpdateRecipe($recipe, $image, $request);
        $message = "Image added successfully";
        $image = new ImageResource($image);
        return $this->sendResponse(compact('image'), $message);
    }

}
