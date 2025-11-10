<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        // Add admin middleware or role check in your project
    }

    public function index(){
        $products = Product::orderBy('created_at','desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'price'=>'required|numeric|min:0.01',
            'stock_quantity'=>'required|integer|min:0',
        ]);
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Product created');
    }

    public function edit(Product $product){
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'price'=>'required|numeric|min:0.01',
            'stock_quantity'=>'required|integer|min:0',
        ]);
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','Product updated');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted');
    }
}
