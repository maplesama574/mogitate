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
        </a>
        <div class="detail-text">
        <p class="list-title">商品名</p>
        <input class="list-input" type="text" name="name" placeholder="{{$product->name}}">
        <p class="list-title">値段</p>
        <input class="list-input" type="text" name="price" placeholder="{{$product->price}}">
        <p class="list-title">季節</p>
        <label class="list-season">
            <input type="radio" name="season" value="spring" {{ old('season', $product->season) === 'spring' ? 'checked' : '' }}>春
        </label>
        <label class="list-season">
            <input type="radio" name="season" value="summer" {{ old('season', $product->season) === 'spring' ? 'checked' : '' }}{$pro}>夏
        </label>
        <label class="list-season">
            <input type="radio" name="season" value="fall" {{ old('season', $product->season) === 'spring' ? 'checked' : '' }}>秋
        </label>
        <label class="list-season">
            <input type="radio" name="season" value="winter" {{ old('season', $product->season) === 'spring' ? 'checked' : '' }}>冬
        </label>
        <div class="product-detail__explain">
            <p class="list-title">商品説明</p>
            <textarea name="description" id="text">{{$product->description}}</textarea>
        </div>
        </div>
        </div>
        <div class="button">
            <a href="{{route('products.index')}}" class="reset-button">戻る</a>
            <button class="confirm-button" type="submit">変更を保存</button>
        </div>
        </form>
    </div>
    </div>
@endsection
