    @extends('layouts.app')
    
    @section('css')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    @endsection

    @section('content')
        <div class="category">
            <div class="category-title">
                <h2>商品一覧</h2>
                <form method="GET" action="{{route('products.register')}}">
                    @csrf
                    <button class="create-button">+商品を追加</button>
            </div>
            <div class="category-content">
                <div class="category-search">
                </form>
                <form method="GET" action="{{route('products.index')}}">
                    @csrf
                    <input class="search-textbox" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                    <button class="category-button">検索</button>
                    <h3>価格順で表示</h3>
                    <select class="category-cost" name="category">
                        <option value="">価格で並べ替え</option>
                        <option value="high-cost">高い順に表示</option>
                        <option value="low-cost">安い順に表示</option>
                    </select>
                </form>
                </div>
                <div class="product-list">
                @foreach ($products as $product)
                <div class="product-item">
                <a href="{{route('products.show', ['productId'=>$product->id])}}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="product-image">
                    </a>
                    <p>{{$product->name}}</p>
                <p>{{$product->price}}円</p>
                </div>
                @endforeach
            </div>
        </div>
        <div class="pagination">
        <ul class="pagination-item">
        <li class="page-item--disabled"><span class="page-link"><</span></li>
        <li class="page-item--active"><a class="page-link" href="?page=1">1</a></li>
        <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
        <li class="page-item"><a class="page-link" href="?page=3">3</a></li>
        <li class="page-item"><a class="page-link" href="?page=3">></a></li>
    </ul>
</div>
@endsection