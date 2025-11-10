@extends('layouts.app')
@section('title','Products')
@section('content')
<h1>Products</h1>
<form method="GET" class="row g-2 mb-3">
    <div class="col-auto"><input name="price_min" class="form-control" placeholder="Min price" value="{{ request('price_min') }}"></div>
    <div class="col-auto"><input name="price_max" class="form-control" placeholder="Max price" value="{{ request('price_max') }}"></div>
    <div class="col-auto"><label><input type="checkbox" name="available" value="1" {{ request('available') ? 'checked' : '' }}> In stock only</label></div>
    <div class="col-auto"><button class="btn btn-primary">Filter</button></div>
</form>
<div class="row">
@foreach($products as $p)
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $p->name }}</h5>
                <p class="card-text">{{ Str::limit($p->description,80) }}</p>
                <p><strong>₹{{ number_format($p->price,2) }}</strong></p>
                <form method="POST" action="{{ route('cart.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <div class="input-group">
                        <input name="quantity" type="number" min="1" value="1" class="form-control" style="width:80px">
                        <button class="btn btn-success">Add to cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>
<div class="mt-3">{{ $products->links() }}</div>
@endsection
