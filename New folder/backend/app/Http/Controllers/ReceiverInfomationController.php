<?php

namespace App\Http\Controllers;

use App\Models\ReceiverInfomation;
use Illuminate\Http\Request;

class ReceiverInfomationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $receiverinfomations = ReceiverInfomation::all();
        return response()->json($receiverinfomations);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(ReceiverInfomation $receiverInfomation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReceiverInfomation $receiverInfomation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReceiverInfomation $receiverInfomation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReceiverInfomation $receiverInfomation)
    {
        //
    }
}
