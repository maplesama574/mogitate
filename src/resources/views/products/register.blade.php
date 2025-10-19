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
            <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <p class="input-title">商品名<span class="input-red">必須</span></p>
                <input class="input-content" type="text" name="name" placeholder="商品名を入力" value="{{old('name')}}">
                @if ($errors->has('name'))
                <div class="error">
                    @foreach ($errors->get('name') as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                </div>
                @endif
                <p class="input-title">値段<span class="input-red">必須</span></p>
                <input class="input-content" type="text" name="price" placeholder="値段を入力" value="{{old('price')}}">
                @if ($errors->has('price'))
                <div class="error">
                    @foreach ($errors->get('price') as $message)
                    <p>{{ $message}}</p>
                    @endforeach
                </div>
                @endif
                <p class="input-title">商品画像<span class="input-red">必須</span></p>
                <img id="image-preview" src="{{ old('image') ? asset('storage/' . old('image')) : '' }}"  style="max-width: 400px; max-height: 300px; display: block; margin-bottom: 10px;">

<input type="file" name="image" id="image-input">

<script>
const input = document.getElementById('image-input');
const preview = document.getElementById('image-preview');

input.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result; 
        }
        reader.readAsDataURL(file);
    }
});
</script>
                @if ($errors->has('image'))
                    <div class="error">
                    @foreach ($errors->get('image') as $message)
                        <p>{{ $message}}</p>
                    @endforeach
                    </div>
                @endif
                <p class="input-title">季節<span class="input-red">必須</span><span class="input-red--detail">複数選択可</span></p>
                @php
    $oldSeasons = old('seasons', []);
@endphp
<label class="season-input">
    <input type="checkbox" name="seasons[]" id="1" {{ in_array('spring', $oldSeasons) ? 'checked' : '' }}>春
</label>
<label class="season-input">
    <input type="checkbox" name="seasons[]" id="2" {{ in_array('summer', $oldSeasons) ? 'checked' : '' }}>夏
</label>
<label class="season-input">
    <input type="checkbox" name="seasons[]" id="3" {{ in_array('fall', $oldSeasons) ? 'checked' : '' }}>秋
</label>
<label class="season-input">
    <input type="checkbox" name="seasons[]" id="4" {{ in_array('winter', $oldSeasons) ? 'checked' : '' }}>冬
</label>

                @if ($errors->has('season'))
                <div class="error">
                @foreach ($errors->get('season') as $message)
                <p>{{ $message }}</p>
                @endforeach
                </div>
                @endif

                <p class="input-title">商品説明<span class="input-red">必須</span></p>
                <textarea class="input-textarea" name="text" placeholder="商品の説明を入力">{{old('text')}}</textarea>
                @if($errors->has('text'))
                <div class="error">
                    @foreach($errors->get('text') as $message)
                    <p>{{$message}}</p>
                    @endforeach
                </div>
                @endif
            <div class="input-button">
            <a class="reset-button" href="{{route('products.index')}}">戻る</a>
            <button class="register-button" type="submit">登録</button>
            </div>
            </form>
        </div>
    </div>
@endsection
