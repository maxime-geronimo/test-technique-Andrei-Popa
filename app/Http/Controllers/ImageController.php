<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageEditPost;
use App\Http\Requests\ImageUploadPost;
use App\Image;
use Appstract\BootstrapComponents\BootstrapComponentsClass;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ImageController
 *
 * @package App\Http\Controllers
 */
class ImageController extends Controller
{
    /**
     * @param       $id
     * @param Image $image
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function setDefault($id, Image $image) {
        // Unset the previously default image(if any)
        $previous_default = $image->where('is_default', 1)->first();

        if(null !== $previous_default) {
            $previous_default->is_default = false;
            if(!$previous_default->save()) {
                throw new \Exception('Unable to save modifications');
            }
        }

        $image = $image->findOrFail($id);
        $image->is_default = true;
        if($image->save()) {
            return redirect('/');
        }

        throw new \Exception('Unable to save modifications');
    }

    /**
     * @param       $id
     * @param Image $image
     *
     * @return View
     */
    public function edit($id, Image $image) {
        return view('edit')->with(['image' => $image->findOrFail($id)]);
    }

    /**
     * @param               $id
     * @param ImageEditPost $imageEditPost
     * @param Image         $image
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function editProcess($id, ImageEditPost $imageEditPost, Image $image) {
        $image_fields = $image->where('id', $id)->first();

        if($image_fields->fill([
            'description' => $imageEditPost->get('file_description'),
            'title' => $imageEditPost->get('file_title'),
        ])->save()) {
            return redirect('edit/' . $image_fields->id)->with(['success' => true]);
        }

        throw new \Exception('Unable to process changes');
    }

    /**
     * @param Image $image
     *
     * @return View
     */
    public function index(Image $image, BootstrapComponentsClass $bootstrapComponentsClass, Request $request) {
        $images = $image->all();
        return view('main')->with([
            'images' => $images,
            'pagination' => $bootstrapComponentsClass->pagination($images, $request->get('page'), 6, '', ['arrows' => true]),
            'default' => $image->where('is_default', 1)->first()
        ]);
    }

    /**
     * @param ImageUploadPost $request
     * @param Image           $image
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function uploadProcess(ImageUploadPost $request, Image $image) {
        $file = $request->file('file_input');
        $file_name = bin2hex(openssl_random_pseudo_bytes(20)) . '.' . $file->extension();

        if($image->fill([
            'name' => $file_name,
            'description' => null,
            'is_default' => false,
            'title' => null,
        ])->save()) {
            $file->move(config('image.storage_folder'), $file_name);
            return redirect('/')->with(['success' => true]);
        }

        throw new \Exception('Unable to process file');
    }

    /**
     * @param       $id
     * @param Image $image
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete($id, Image $image) {
        $image = $image->where('id', $id)->first();

        if(\File::exists(config('image.storage_folder'), $image->name)) {
            \File::delete(config('image.storage_folder') . DIRECTORY_SEPARATOR . $image->name);
        }

        if($image->delete()) {
            return redirect()->route('main')->with(['delete_success' => true]);
        }

        throw new \Exception('Unable to process changes');
    }
}
