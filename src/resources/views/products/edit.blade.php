@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">

<div class="edit-container">
    <p><a href="{{ route('products.index') }}">商品一覧</a> ＞ {{ $product->name }}</p>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
    @csrf
    @method('PUT')

@php
$selectedSeasons = old('seasons', $product->seasons ?? []);

$path = $product->image_path;
$existsInStorage = $path && \Illuminate\Support\Facades\Storage::disk('public')->exists($path);
$imageUrl = $existsInStorage ? asset('storage/' . $path) : '';
@endphp

    <!-- 上部：画像 + 右側の項目 -->
    <div class="form-row-top">
        <!-- 左：画像とファイル -->
        <div class="form-left">
            <img id="preview" src="{{ $imageUrl }}" class="image-preview">
            <div class="file-select-row">
                <label for="image" class="custom-file-upload">ファイルを選択</label>
                <input id="image" type="file" name="image" class="file-input" onchange="showPreview(event)">
                <span class="filename" id="filename"></span>
            </div>
            @error('image')
    <div class="error">{{ $message }}</div>
@enderror
        </div>

        <!-- 右：商品名・値段・季節 -->
        <div class="form-top-right">
            <div class="form-group">
                <label for="name">商品名</label>
                <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}">
            </div>

            <div class="form-group">
                <label for="price">値段</label>
                <input id="price" type="number" name="price" value="{{ old('price', $product->price) }}">
            </div>

            <div class="form-group">
                <label>季節</label>
                <div class="season-checkboxes">
                    @foreach (['春', '夏', '秋', '冬'] as $season)
                        <label>
                            <input type="checkbox" name="seasons[]" value="{{ $season }}"
                                {{ in_array($season, $selectedSeasons) ? 'checked' : '' }}>
                            {{ $season }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- 商品説明（横幅いっぱい） -->
    <div class="form-bottom">
    <div class="form-group description-group">
        <label for="description">商品説明</label>
        <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="form-buttons-layout">
    <div class="center-buttons">
        <a href="{{ route('products.index') }}" class="btn gray-btn">戻る</a>
        <button type="submit" class="btn yellow-btn">変更を保存</button>
    </div>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form-inline" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn red-btn">🗑️</button>
    </form>
</div>
</div>
@endsection






