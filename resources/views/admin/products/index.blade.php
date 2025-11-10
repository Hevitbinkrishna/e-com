@extends('layouts.app')
@section('title','Admin - Products')
@section('content')
<div class="d-flex justify-content-between"><h1>Products</h1><a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add</a></div>
<table class="table mt-3"><thead><tr><th>Name</th><th>Price</th><th>Stock</th><th></th></tr></thead><tbody>
@foreach($products as $p)
<tr>
    <td>{{ $p->name }}</td>
    <td>₹{{ number_format($p->price,2) }}</td>
    <td>{{ $p->stock_quantity }}</td>
    <td>
        <a class="btn btn-sm btn-warning" href="{{ route('admin.products.edit', $p) }}">Edit</a>
        <form method="POST" action="{{ route('admin.products.destroy', $p) }}" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form>
    </td>
</tr>
@endforeach
</tbody></table>
<div>{{ $products->links() }}</div>
@endsection
