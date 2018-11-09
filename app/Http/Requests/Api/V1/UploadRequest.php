<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'type' => 'string',
        ];
//
//        if ($this->type == 'image') {
//            $rules['file'] = 'required|mimes:jpg,jpeg,png,gif,bmp';
//        }
//            $rules['file'] = 'required|mimes:mp4,avi,rmvb,mkv';
//        } else {
//            $rules['file'] = 'required|mimes:txt';
//        }
//
        return $rules;
    }
}
