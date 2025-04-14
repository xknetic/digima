<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carts = Cart::with(['inventories', 'slots'])->get();
        return response()->json($carts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $request->validate([
            // Database Table
            // 'item_id' => 'required|array',
        ]);

        // foreach ($request->item_id as $itemId) {
        //     Cart::create([
        //         'item_id' => $itemId,
        //         'cart_quantity' => $request->input('cart_quantity'),
        //         'slot_id' => $request->input('slot_id'),
        //     ]);
        // }
        Cart::create($request->all());

        return response()->json("Cart Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart, $id)
    {
        //
        $cart = Cart::findOrFail($id);

        $request->validate([
            // 'inventory_id' => 'required',
            'cart_quantity' => 'required',
            // 'slot_id' => 'required',
        ]);
        // dd($request);

        $cart->update($request->all());

        return response()->json($cart);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json(null, 204);
    }
}
