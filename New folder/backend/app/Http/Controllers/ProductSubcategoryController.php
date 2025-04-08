<?php

namespace App\Http\Controllers;

use App\Models\ProductSubcategory;
use Illuminate\Http\Request;

class ProductSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subCategories = ProductSubcategory::all();
        return response()->json($subCategories);
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

        ProductSubcategory::create($request->all());
        return response()->json("Product Sub Category Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductSubcategory $productSubcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductSubcategory $productSubcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductSubcategory $productSubcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductSubcategory $productSubcategory)
    {
        //
    }
}
