    @extends('layouts.app')
    
    @section('css')
    <link rel="stylesheet" href="{{asset('css/products.css')}}">
    @endsection

    @section('content')
        <div class="category">
            <div class="category-title">
                <h1>商品一覧</h1>
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
                    <img src="{{ asset('storage/products/' . basename($product->image)) }}" alt="{{ $product->name }}" class="product-image">
                    </a>
                    <div class="product-content">
                    <p class="product-name">{{$product->name}}</p>
                    <p class="product-price">
                    {{$product->price}}円
                    </p>
                </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="pagination">
        <ul class="pagination-item">
            
    @if ($products->onFirstPage())
        <li class="page-item--disabled"><span class="page-link">＜</span></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}">＜</a></li>
    @endif

    @for ($i = 1; $i <= $products->lastPage(); $i++)
        <li class="{{ $i == $products->currentPage() ? 'page-item--active' : 'page-item' }}">
            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
        </li>
    @endfor

    @if ($products->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">＞</a></li>
    @else
        <li class="page-item--disabled"><span class="page-link">＞</span></li>
    @endif
</ul>

</div>
@endsection