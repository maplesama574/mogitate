 @extends('layouts.app')
    
    @section('css')
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    @endsection

@section('content')
    <div class="detail">
        <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="product-list">
        <a class="product-list--blue" href="{{route('products.index')}}">商品一覧</a>
        <p class="product-list--text">></p>
        <p class="product-list--text">{{$product->name}}</p>
        </div>
    <div class="product-detail">
        <a href="{{url('/products/' . $product->id)}}">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="detail-img">
        <div class="image-input">
        <input type="file" name="image" id="image" accept="image/*">
        </div>
        </a>
        <div class="detail-text">
        <p class="list-title">商品名</p>
        <input class="list-input" type="text" name="name" value="{{$product->name}}">
        <p class="list-title">値段</p>
        <input class="list-input" type="text" name="price" value="{{$product->price}}">
        <p class="list-title">季節</p>
        <div class="season-box">
        @php
    $checkedSeasons = $product->seasons->pluck('name')->toArray();
@endphp

<label class="list-season">
    <input type="checkbox" name="seasons[]" value="1" {{ in_array('1', $checkedSeasons) ? 'checked' : '' }}>春
</label>
<label class="list-season">
    <input type="checkbox" name="seasons[]" value="2" {{ in_array('2', $checkedSeasons) ? 'checked' : '' }}>夏
</label>
<label class="list-season">
    <input type="checkbox" name="seasons[]" value="3" {{ in_array('3', $checkedSeasons) ? 'checked' : '' }}>秋
</label>
<label class="list-season">
    <input type="checkbox" name="seasons[]" value="4" {{ in_array('4', $checkedSeasons) ? 'checked' : '' }}>冬
</label>
        </div>
        </div>
        </div>
        <div class="product-detail__explain">
            <p class="list-title">商品説明</p>
            <textarea name="description" id="text" class="list-text">{{$product->description}}</textarea>
        </div>
        <div class="button">
            <a href="{{route('products.index')}}" class="reset-button">戻る</a>
            <button class="confirm-button" type="submit">変更を保存</button>
        </div>
        </form>
    </div>
    </div>
@endsection
