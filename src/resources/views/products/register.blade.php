 @extends('layouts.app')
    
    @section('css')
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    @endsection

@section('content')
    <div　class="register-form">
        <h2>商品登録</h2>
        <div class="input-form">
            <form action="POST" value="">
                @csrf
                <p class="input-title">商品名<span class="input-red">必須</span></p>
                <input type="text" name="item" placeholder="商品名を入力">
                <p class="input-title">値段<span class="input-red">必須</span></p>
                <input type="text" name="price" placeholder="値段を入力">
                <p class="input-title">商品画像<span class="input-red">必須</span></p>
                /*画像の選択*/
                <p class="input-title">季節<span class="input-red">必須</span><span class="input-red--detail">複数選択可</span></p>
                <label>
                    <input type="radio" name="season" value="spring">春
                </label>
                <label>
                    <input type="radio" name="season" value="summer">夏
                </label>
                <label>
                <input type="radio" name="season" value="fall">秋
                </label>
                <label>
                <input type="radio" name="season" value="winter">冬
                </label>
                <p class="input-title">商品説明<span class="input-red">必須</span></p>
                <textarea name="text">商品の説明を入力</textarea>
                
登録戻る


            </form>
        </div>
    </div>
