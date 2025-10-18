 @extends('layouts.app')
    
    @section('css')
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    @endsection

@section('content')
    <div class="register">
        <div class="register-title">
            <h2>商品登録</h2>
        </div>
        <div class="register-form">
            <form method="POST" action="{{route('products.index')}}">
                @csrf
                <p class="input-title">商品名<span class="input-red">必須</span></p>
                <input class="input-content" type="text" name="name" placeholder="商品名を入力">
                <p class="input-title">値段<span class="input-red">必須</span></p>
                <input class="input-content" type="text" name="price" placeholder="値段を入力">
                <p class="input-title">商品画像<span class="input-red">必須</span></p>
                <input type="file" name="image" id="image">
                <p class="input-title">季節<span class="input-red">必須</span><span class="input-red--detail">複数選択可</span></p>
                <label class="season-input">
                    <input type="radio" name="season" value="spring">春
                </label>
                <label class="season-input">
                    <input type="radio" name="season" value="summer">夏
                </label>
                <label class="season-input">
                <input type="radio" name="season" value="fall">秋
                </label>
                <label class="season-input">
                <input type="radio" name="season" value="winter">冬
                </label>
                <p class="input-title">商品説明<span class="input-red">必須</span></p>
                <textarea class="input-textarea" name="text" placeholder="商品の説明を入力"></textarea>
            </form>
        </div>
        <div class="input-button">
            <a class="reset-button" href="{{route('products.index')}}">戻る</a>
            <a class="register-button" href="{{route('products.index')}}">登録</a>
        </div>
    </div>
@endsection
