<?php

namespace App\Http\Controllers;

use App\Models\RewardItem;
use Illuminate\Http\Request;

class RewardItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rewardItems = RewardItem::all();
        return response()->json($rewardItems);
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
        ]);

        RewardItem::create($request->all());
        return response()->json("Reward Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(RewardItem $rewardItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RewardItem $rewardItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RewardItem $rewardItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RewardItem $rewardItem)
    {
        //
    }
}
