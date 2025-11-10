<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request){
        $query = Product::query();
        if($request->filled('price_min')){
            $query->where('price','>=',$request->price_min);
        }
        if($request->filled('price_max')){
            $query->where('price','<=',$request->price_max);
        }
        if($request->filled('available')){
            $query->where('stock_quantity','>',0);
        }
        $products = $query->paginate(12);
        return view('welcome', compact('products'));
    }
}
