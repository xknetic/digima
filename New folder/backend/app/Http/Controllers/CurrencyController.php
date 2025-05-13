<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $currencies = Currency::all();
        return response()->json($currencies);
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
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency, $currency_id)
    {
        //
        $currency = Currency::findOrFail($currency_id);

        $request->validate([
            'currency_buying' => 'nullable|in:0,1',
    'currency_default' => 'nullable|in:0,1',
        ]);

        if ($request->currency_buying == 1) {
            Currency::where('currency_id', '!=', $currency_id)->update(['currency_buying' => 0]);
        }
        
        if ($request->currency_default == 1) {
            Currency::where('currency_id', '!=', $currency_id)->update(['currency_default' => 0]);
        }

        $currency->update($request->all());

        return response()->json($currency);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
