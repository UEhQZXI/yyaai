<?php

namespace App\Http\Requests\Api\V1\Store;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
                $res = [];
                $res['address_id'] = 'required|int';
                
                if (!$this->type) {
                    $res['type'] = 'required'; 
                } else if ($this->type == 'direct') {
                    $res['product_id'] = 'required|int';
                    $res['num'] = 'required|int';
                } else {
                    $res['cart_ids'] = 'required';
                }

                return $res;
                break;
            
            default:
                return [
                    'status' => 'int',
                    'price' => 'int'
                ];
                break;
        }
        
    }

    public function messages()
    {
        return [
            'address_id.required' => '缺少参数address_id',
            'product_ids.required' => '缺少参数product_ids',
            'price.required' => '缺少参数price',
            'num.required' => '缺少参数num'
        ];
    }
}
