@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報編集画面</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" value="{{ $product->id }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">商品名 <span class="text-danger">*</span></label>
            <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}">
            @error('product_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">メーカー名 <span class="text-danger">*</span></label>
            <select name="company_id" class="form-control">
                <option value="">選択してください</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">価格 <span class="text-danger">*</span></label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">在庫数 <span class="text-danger">*</span></label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">コメント</label>
            <textarea name="comment" class="form-control">{{ old('comment', $product->comment) }}</textarea>
            @error('comment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">商品画像</label>
            <input type="file" name="img_path" class="form-control">
            @error('img_path')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @if($product->img_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <div class="d-flex">
            <button type="submit" class="btn" style="background-color: #D97706; color: white; margin-right: 5px;">更新</button>
            <a href="{{ route('products.index') }}" class="btn btn-primary">戻る</a>
        </div>
    </form>
</div>
@endsection
