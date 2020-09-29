<?php

namespace App\Http\Requests\API;

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
        return [
            'product_id' => 'required|unique:products,product_id|max:50',
            'product_name' => 'required|max:50',
            'harga' => 'required|numeric|max:5000000',
            'merk' => 'required|string|max:100',
        ];
    }
}
