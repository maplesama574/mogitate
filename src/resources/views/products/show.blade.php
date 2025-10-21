 @extends('layouts.app')
    
    @section('css')
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    @endsection

@section('content')
    <div class="detail">
        <form action="{{ route('products.update', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="product-list">
        <a class="product-list--blue" href="{{route('products.index')}}">商品一覧</a>
        <p class="product-list--text">></p>
        <p class="product-list--text">{{$product->name}}</p>
        </div>
    <div class="product-detail">
        <a href="{{url('/products/' . $product->id)}}">
        <img src="{{ asset('storage/products/' . basename($product->image)) }}" alt="{{ $product->name }}" class="detail-img">
        <div class="image-input">
        <input type="file" name="image" id="image" accept="image/*">
        @if ($errors->has('image'))
                <div class="error">
                    @foreach ($errors->get('image') as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                </div>
        @endif
        </div>
        </a>
        <div class="detail-text">
        <p class="list-title">商品名</p>
        <input class="list-input" type="text" name="name" value="{{old('name', $product->name)}}">
        @if ($errors->has('name'))
                <div class="error">
                    @foreach ($errors->get('name') as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                </div>
        @endif
        <p class="list-title">値段</p>
        <input class="list-input" type="text" name="price" value="{{ old('price', $product->price)}}">
        @if ($errors->has('price'))
                <div class="error">
                    @foreach ($errors->get('price') as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                </div>
        @endif
        <p class="list-title">季節</p>
        <div class="season-box">
        @php
$checkedSeasons = old('seasons', $product->seasons->pluck('id')->map(fn($id)=> (string)$id)->toArray());
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
@if ($errors->has('seasons'))
    <div class="error">
        @foreach ($errors->get('seasons') as $message)
            <p>{{ $message }}</p>
        @endforeach
    </div>
@endif

</label>
        </div>
        </div>
        </div>
        <div class="product-detail__explain">
            <p class="list-title">商品説明</p>
            <textarea name="description" id="text" class="list-text">{{$product->description}}</textarea>
            @if ($errors->has('description'))
                <div class="error">
                    @foreach ($errors->get('description') as $message)
                    <p>{{ $message }}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="button">
            <a href="{{route('products.index')}}" class="reset-button">戻る</a>
            <button class="confirm-button" type="submit">変更を保存</button>
        </div>
        </form>
        <div class="delete-box">
        <form action="{{ route('products.delete', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button">🗑️ 削除</button>
    </form>
    </div>
    </div>
    </div>
@endsection
