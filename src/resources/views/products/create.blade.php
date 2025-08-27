@extends('layouts.app')

@section('title', '商品登録')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<div class="pg-wrap">
  <h1 class="pg-title">商品登録</h1>

  <form class="card form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- 商品名 --}}
    <div class="form-row">
      <label class="form-label">商品名 <span class="req">必須</span></label>
      <input type="text" name="name" class="input" value="{{ old('name') }}" placeholder="商品名を入力">
      @error('name') <p class="err">{{ $message }}</p> @enderror
    </div>

    {{-- 価格 --}}
    <div class="form-row">
      <label class="form-label">価格 <span class="req">必須</span></label>
     <input type="number" name="price" class="input" value="{{ old('price') }}" placeholder="価格を入力">
      @error('price') <p class="err">{{ $message }}</p> @enderror
    </div>

    {{-- 商品画像 --}}
    <div class="form-row">
      <label class="form-label">商品画像 <span class="req">必須</span></label>
      <input type="file" name="image" class="input-file" accept="image/*" onchange="previewImage(event)">
      @error('image') <p class="err">{{ $message }}</p> @enderror

      <div class="preview">
        <img id="preview" alt="preview" src="{{ old('image_path') ? Storage::url(old('image_path')) : '' }}">
        <p class="preview-filename" id="previewName"></p>
      </div>
    </div>

{{-- 季節 --}}
<div class="form-row">
  <label class="form-label">季節 <span class="req">必須</span></label>

  <div class="checkbox-line">
    @php $seasonList = ['春','夏','秋','冬']; @endphp
    @foreach($seasonList as $s)
      <label class="checkbox">
        <input
          type="checkbox"
          name="seasons[]"
          value="{{ $s }}"
          @php
            $selected = collect(old('seasons', isset($product) ? $product->seasons : []))->contains($s);
          @endphp
          {{ $selected ? 'checked' : '' }}
        >
        <span>{{ $s }}</span>
      </label>
    @endforeach
  </div>

 <div>
  @error('seasons')
    <p class="err">{{ $message }}</p>
  @enderror
</div>
</div>

{{-- 商品説明 --}}
<div class="form-row">
  <label class="form-label" for="description">商品説明 <span class="req">必須</span></label>
  <textarea id="description" name="description" class="textarea" rows="5" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
  @error('description') <p class="err">{{ $message }}</p> @enderror
</div>

{{-- ボタン --}}
<div class="form-actions">
  <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
  <button type="submit" class="btn btn-primary">登録</button>
</div>
  </form>
</div>

{{-- 画像プレビュー --}}
<script>
  function previewImage(e){
    const file = e.target.files[0];
    const img = document.getElementById('preview');
    const name = document.getElementById('previewName');
    if(!file){ img.src=''; name.textContent=''; return; }
    img.src = URL.createObjectURL(file);
    name.textContent = 'ファイル名：' + file.name;
  }
</script>
@endsection