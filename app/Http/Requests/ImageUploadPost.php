<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ImageUploadPost
 *
 * @package App\Http\Requests
 */
class ImageUploadPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // No point in gates since there are no users
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file_input' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ];
    }
}
