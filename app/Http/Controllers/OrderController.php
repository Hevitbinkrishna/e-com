<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Cart, Order, OrderItem, Product};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $orders = Order::with('items.product')->where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request){
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('product')->get();
        if($carts->isEmpty()){
            return back()->withErrors('Cart is empty');
        }
        DB::beginTransaction();
        try{
            $total = 0;
            foreach($carts as $c){
                if($c->quantity > $c->product->stock_quantity){
                    throw new \Exception('Insufficient stock for: ' . $c->product->name);
                }
                $total += $c->quantity * $c->product->price;
            }
            $order = Order::create(['user_id'=>$user->id,'total_price'=>$total]);
            foreach($carts as $c){
                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$c->product_id,
                    'quantity'=>$c->quantity,
                    'price'=>$c->product->price,
                ]);
                // reduce stock
                $p = $c->product;
                $p->stock_quantity -= $c->quantity;
                $p->save();
            }
            Cart::where('user_id',$user->id)->delete();
            DB::commit();

            // send mail (ensure mail configured)
            Mail::to($user->email)->send(new OrderConfirmationMail($order));

            return redirect()->route('orders.index')->with('success','Order placed');
        }catch(\Exception $e){
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
    }
}
