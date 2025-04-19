<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_id'   => 'required|exists:companies,id',
            'product_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'comment'      => 'nullable|string|max:1000',
            'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
