 @extends('layouts.app')
    
    @section('css')
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    @endsection

@section('content')
    <div class="detail">
        <form action="{{route('products.update', $product->id)}}" method="POST" >
            @csrf
            @method('PUT')
    <div class="product-list">
        <a class="product-list--blue" href="{{route('products.index')}}">商品一覧</a>
        <p>></p>
        <p>{{$、、、}}</p>
    </div>
    <div class="product-detail">
        <input type="file" name="image" id="image">
        <p class="list-title">商品名</p>
        <input type="text" name="name" placeholder={{$,,,,}}>
        <p class="list-title">値段</p>
        <input type="text" name="price" placeholder={{$,,,,}}>
        <p class="list-title">季節</p>
        <label class="list-season">
            <input type="radio" name="season" value="spring" {{$product->season === 'spring' ? 'checked' : ''}}>春
        </label>
        <label class="list-season">
            <input type="radio" name="season" value="summer" {{$product->season === 'summer' ? 'checked' : ''}}>夏
        </label>
        <label class="list-season">
            <input type="radio" name="season" value="fall" {{$product->season === 'fall' ? 'checked' : ''}}>秋
        </label>
        <label class="list-season">
            <input type="radio" name="season" value="winter" {{$product->season === 'winter' ? 'checked' : ''}}>冬
        </label>
        <div class="product-detail__explain">
            <p class=""list-title>商品説明</p>
            <textarea name="text" id="text" placeholder="商品の説明を入力"></textarea>
        </div>
        <div class="button">
            <a href="{{route('products.index')}}">戻る</a>
            <button type="submit">変更を保存</button>
        </div>
        </div>
        </form>
    </div>
@endsection
