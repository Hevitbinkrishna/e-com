@extends('layouts.app')
@section('title','Edit Product')
@section('content')
<h1>Edit Product</h1>
<form method="POST" action="{{ route('admin.products.update', $product) }}">@csrf @method('PUT')
    <div class="mb-3"><label>Name</label><input name="name" value="{{ $product->name }}" class="form-control"></div>
    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control">{{ $product->description }}</textarea></div>
    <div class="mb-3"><label>Price</label><input name="price" value="{{ $product->price }}" class="form-control" type="number" step="0.01"></div>
    <div class="mb-3"><label>Stock</label><input name="stock_quantity" value="{{ $product->stock_quantity }}" class="form-control" type="number"></div>
    <button class="btn btn-primary">Save</button>
</form>
@endsection
