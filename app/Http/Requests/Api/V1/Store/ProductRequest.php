<?php

namespace App\Http\Requests\Api\V1\Store;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method()) {
        case 'POST':
            return [
                    'category_id' => 'required|int',
                    'title' => 'required|string',
                    'description' => '',
                    'model' => 'required|string',
                    'original_price' => 'required',
                    'group_number' => '',
                    'numbering' => '',
                    'current_price' => 'required',
                    'inventory' => 'required|int',
                    'status' => 'required|int',
                    'image1' => 'required|string',
                    'image2' => '',
                    'image3' => '',
                    'image4' => '',
                    'image5' => '',
                ];
                break;
        case 'PATCH':
            return [
                    'category_id' => 'int',
                    'title' => 'string',
                    'description' => '',
                    'model' => 'string',
                    'numbering' => '',
                    'original_price' => '',
                    'current_price' => '',
                    'inventory' => 'int',
                    'status' => 'int',
                    'image1' => 'string',
                    'image2' => '',
                    'image3' => '',
                    'image4' => '',
                    'image5' => ''
                ];
                break;
        default:
            // code...
            break;
        }
    }
}
