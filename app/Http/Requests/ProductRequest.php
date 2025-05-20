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
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'company_id'   => 'メーカー',
            'price'        => '価格',
            'stock'        => '在庫',
            'comment'      => 'コメント',
            'img_path'     => '商品画像',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max'      => ':attributeは:max文字以内で入力してください。',
            'company_id.required'   => ':attributeは必須項目です。',
            'company_id.integer'    => ':attributeは数値で入力してください。',
            'company_id.exists'     => '選択された:attributeが無効です。',
            'price.required'        => ':attributeは必須項目です。',
            'price.numeric'         => ':attributeは数値で入力してください。',
            'price.min'             => ':attributeは0以上で入力してください。',
            'stock.required'        => ':attributeは必須項目です。',
            'stock.integer'         => ':attributeは整数で入力してください。',
            'stock.min'             => ':attributeは0以上で入力してください。',
            'comment.max'           => ':attributeは:max文字以内で入力してください。',
            'img_path.image'        => ':attributeは画像ファイルである必要があります。',
            'img_path.mimes'        => ':attributeはjpeg,png,jpg,gif形式である必要があります。',
            'img_path.max'          => ':attributeは2MB以内にしてください。',
        ];
    }
}
