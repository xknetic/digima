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
    public function update(Request $request, Currency $currency, $id)
    {
        //
        $currencies = Currency::all();
        $currency = Currency::findOrFail($id);

        $request->validate([]);

        dd($request);

        if ($request->currency_buying == 1) {
            foreach ($currencies as $currencies) {
                if ($currencies->currency_buying == 0) {

                    dd($currencies);
                    $currencies->update([
                        'currency_buying' => 0,
                    ]);
                }
            }
        }

        // foreach ($currencies as $x) {
        //     if ($x->currency_buying == 1) {
        //         $currency = [
        //             'currency_buying' => 0,
        //         ];
        //         $currency->save();
        //     }
        // }

        // dd($request);

        // $currency->update($request->all());

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
