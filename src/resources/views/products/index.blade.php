@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">

<div class="container">
   <div class="sidebar">
    <h2>商品一覧</h2>

    @if(request()->filled('keyword'))
        <p>“{{ request('keyword') }}”の商品一覧</p>
    @endif

    <form method="GET" action="{{ route('products.index') }}">
        <div class="search-box">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit">検索</button>
        </div>

        <div class="sort-box">
            <label for="sort">価格順で表示</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="">選択してください</option>
                <option value="asc" {{ request('sort')=='asc' ? 'selected' : '' }}>安い順</option>
                <option value="desc" {{ request('sort')=='desc' ? 'selected' : '' }}>高い順</option>
            </select>
        </div>
    </form>
</div>

    <!-- 商品一覧 -->
    <div class="content">
        <div class="add-btn">
            <a href="{{ route('products.create') }}">+ 商品を追加</a>
        </div>

        <div class="product-grid">
    @foreach ($products as $product)
        @php
            $path = $product->image_path;
            if ($path && \Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                // storage/app/public/... に実在
                $src = \Illuminate\Support\Facades\Storage::url($path);
            } elseif ($path && file_exists(public_path(trim($path, '/')))) {
                // DBに public 側の相対パスが入っているケース (例: images/products/xxx.jpg)
                $src = asset($path);
            } elseif ($path && file_exists(public_path('images/products/' . basename((string)$path)))) {
                // 旧データでファイル名だけ持っているケース
                $src = asset('images/products/' . basename((string)$path));
            } else {
                // それでも無ければプレースホルダー
                $src = asset('images/no-image.png');
            }
        @endphp

        <a href="{{ route('products.edit', $product->id) }}" class="product-card-link">
            <div class="product-card">
                <img src="{{ $src }}" alt="{{ $product->name }}">
                <div class="product-name">{{ $product->name }}</div>
                <div class="product-price">¥{{ number_format($product->price) }}</div>
            </div>
        </a>
    @endforeach
</div>

        <div class="pagination">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection