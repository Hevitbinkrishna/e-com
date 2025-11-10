@extends('layouts.app')
@section('title','Your Cart')
@section('content')
<h1>Your Cart</h1>
<table class="table">
    <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th><th></th></tr></thead>
    <tbody>
        @foreach($items as $i)
        <tr>
            <td>{{ $i->product->name }}</td>
            <td>
                <form method="POST" action="{{ route('cart.update', $i) }}">@csrf @method('PATCH')
                    <input type="number" name="quantity" value="{{ $i->quantity }}" min="1" style="width:80px" class="form-control d-inline-block">
                    <button class="btn btn-sm btn-primary">Update</button>
                </form>
            </td>
            <td>₹{{ number_format($i->product->price,2) }}</td>
            <td>₹{{ number_format($i->quantity * $i->product->price,2) }}</td>
            <td>
                <form method="POST" action="{{ route('cart.destroy', $i) }}">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Remove</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form method="POST" action="{{ route('orders.store') }}">@csrf<button class="btn btn-success">Place Order</button></form>
@endsection
