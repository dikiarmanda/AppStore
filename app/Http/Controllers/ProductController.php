<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products = Product::get();

        return view('products', ['products' => $products]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'details' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        Product::create([
            'name' => $request['name'],
            'details' => $request['details'],
            'stock' => $request['stock'],
            'price' => $request['price'],
        ]);

        return redirect()
                ->back()
                ->with('success', 'Data produk berhasil disimpan');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:products.id']
        ]);

        $product = Product::find($request->input('id'));
        $product->delete();

        return redirect()
                ->back()
                ->with('success', 'Data produk berhasil dihapus');
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('products-edit', ['product' => $product]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'details' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'integer']
        ]);
        
        $product = Product::find($id);
        $product->update([
            'name' => $request->input('name'),
            'details' => $request->input('details'),
            'stock' => $request->input('stock'),
            'price' => $request->input('price')
        ]);

        return redirect()
                ->route('products')
                ->with('success', 'Data dengan id ' . $id . ' produk berhasil update');
    }
}
