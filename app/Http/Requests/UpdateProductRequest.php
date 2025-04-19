// UpdateProductRequest.php
public function rules()
{
    return [
        'company_id'   => 'required|exists:companies,id',
        'product_name' => 'required|string|max:255',
        'price'        => 'required|numeric|min:0',
        'stock'        => 'required|integer|min:0',
        'comment'      => 'nullable|string|max:1000',
        'img'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
}
