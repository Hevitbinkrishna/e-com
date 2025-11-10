@extends('layouts.app')
@section('title','Orders')
@section('content')
<h1>Your Orders</h1>
@foreach($orders as $order)
<div class="card mb-2">
    <div class="card-body">
        <h5>Order #{{ $order->id }} — ₹{{ number_format($order->total_price,2) }} <small class="text-muted">{{ $order->created_at->format('d M Y') }}</small></h5>
        <ul>
            @foreach($order->items as $it)
            <li>{{ $it->product->name }} — {{ $it->quantity }} × ₹{{ number_format($it->price,2) }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endforeach
@endsection
