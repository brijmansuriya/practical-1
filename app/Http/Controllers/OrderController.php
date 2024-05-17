<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('order.add', compact('users'));
    }

    public function store(OrderRequest $request)
    {
        DB::transaction(function () use ($request) {
            $order = Order::create([
                'user_id' => $request->user_id,
            ]);

            $products = collect($request->product)->map(function ($prod, $index) use ($request, $order) {
                return [
                    'order_id' => $order->id,
                    'name' => $prod,
                    'amount' => $request->amount[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();


            Product::insert($products);
        });

        return redirect(route('home'))->with('success', 'Order added successfully.');
    }

    public function view($id)
    {
        $order = Order::with('products','user')->whereId($id)->whereHas('products')->firstOrFail();
        return view('order.view', compact('order'));
    }
}
