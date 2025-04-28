<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\ReceiverInfomation;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Orders::all();
        return response()->json($orders);
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
        $request->validate([]);
        $receiverInfomations = $request->only([
            'receiver_first_name',
            'receiver_last_name',
            'receiver_contact',
            'receiver_address',
            'receiver_barangay',
            'receiver_city',
            'receiver_province',
            'receiver_postal',
        ]);

        $receiverInfomations = ReceiverInfomation::create($receiverInfomations);
        
        $orders = $request->only([
            'subtotal',
            'buyer_slot_id',
            'grand_total',
            'receiver_id',
        ]);

        $orders['receiver_id'] = $receiverInfomations->receiver_id;

        $orders = Orders::create($orders);

        $orderItems = $request->only([
            'order_id',
            'item_id',
            'quantity',
            'order_item_subtotal',
            'order_item_price',
        ]);

        $orderItems['order_id'] = $orders->order_id;

        $orderItems = OrderItems::create($orderItems);

        return response()->json(['message' => 'Order created successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
