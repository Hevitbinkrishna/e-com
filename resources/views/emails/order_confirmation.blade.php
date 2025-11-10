<p>Hi,</p>
<p>Thanks for your order. Your order #{{ $order->id }} was placed successfully.</p>
<ul>
@foreach($order->items as $it)
    <li>{{ $it->product->name }} — {{ $it->quantity }} × ₹{{ number_format($it->price,2) }}</li>
@endforeach
</ul>
<p>Total: ₹{{ number_format($order->total_price,2) }}</p>
