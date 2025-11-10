<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $items = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('items'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'product_id'=>'required|exists:products,id',
            'quantity'=>'required|integer|min:1',
        ]);
        $product = Product::findOrFail($data['product_id']);
        if($data['quantity'] > $product->stock_quantity){
            return back()->withErrors('Quantity exceeds stock');
        }
        $cart = Cart::firstOrCreate([
            'user_id'=>Auth::id(),
            'product_id'=>$product->id
        ],['quantity'=>0]);
        $cart->quantity += $data['quantity'];
        $cart->save();
        return redirect()->route('cart.index')->with('success','Added to cart');
    }

    public function update(Request $request, Cart $cart){
        $this->authorize('update',$cart);
        $data = $request->validate(['quantity'=>'required|integer|min:1']);
        $product = Product::findOrFail($cart->product_id);
        if($data['quantity'] > $product->stock_quantity){
            return back()->withErrors('Quantity exceeds stock');
        }
        $cart->quantity = $data['quantity'];
        $cart->save();
        return back()->with('success','Cart updated');
    }

    public function destroy(Cart $cart){
        $this->authorize('delete',$cart);
        $cart->delete();
        return back()->with('success','Removed from cart');
    }
}
