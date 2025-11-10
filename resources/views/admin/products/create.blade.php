@extends('layouts.app')
@section('title','Create Product')
@section('content')
<h1>Create Product</h1>
<form method="POST" action="{{ route('admin.products.store') }}">@csrf
    <div class="mb-3"><label>Name</label><input name="name" class="form-control"></div>
    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
    <div class="mb-3"><label>Price</label><input name="price" class="form-control" type="number" step="0.01"></div>
    <div class="mb-3"><label>Stock</label><input name="stock_quantity" class="form-control" type="number"></div>
    <button class="btn btn-primary">Save</button>
</form>
@endsection
