<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\JsonResponse;

/**
 * Class ImageController
 *
 * @package App\Http\Controllers\Api
 */
class ImageController extends Controller
{
    /**
     * @param       $id
     * @param Image $image
     *
     * @return JsonResponse
     */
    public function get($id, Image $image) {
        // Some fields can be excluded if necessary
//        return new JsonResponse($image->where('id', $id)->exclude(['created_at', 'updated_at'])->first());
        return new JsonResponse($image->where('id', $id)->first());
    }

    /**
     * @param Image $image
     *
     * @return JsonResponse
     */
    public function all(Image $image) {
        return new JsonResponse($image->all());
    }
}
