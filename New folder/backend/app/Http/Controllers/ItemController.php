<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Item;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $items = Item::all();
        return response()->json($items);
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
        $request->validate([
            // Database Table
            'item_sku' => 'required',
            'item_price' => 'required',
            'item_charged' => 'required',
            'qty_charged' => 'required',
            'item_type' => 'required',
        ]);

        $items = Item::create($request->all());

        $items = Item::all();
        $branches = Branch::all();
        foreach ($items as $item) {
            foreach ($branches as $branch) {
                // Check if the inventory already exists for the specific item and branch
                $existingInventory = Inventory::where('inventory_item_id', $item->item_id)
                    ->where('inventory_branch_id', $branch->branch_id)
                    ->first();
    
                // If inventory doesn't exist, create a new one
                if (!$existingInventory) {
                    Inventory::create([
                        'inventory_item_id' => $item->item_id,
                        'inventory_branch_id' => $branch->branch_id,
                    ]);
                }
            }
        }

        // Inventory::create($inventory);

        return response()->json("Item Created");
    }

    /**
     * Display the specified resource.
     */
    public function show($item_id)
    {
        $item = Item::find($item_id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
