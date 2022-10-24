<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Validation\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        $products = Product::select('id', 'name')->get();

        return view('pages.order.index', compact('orders', 'products'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $user = $request->user();
        $user->orders()
                ->create([
                    'total' => 2,
                    'status' => 3,
        ]);
    }
}
