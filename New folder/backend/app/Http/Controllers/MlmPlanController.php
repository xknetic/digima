<?php

namespace App\Http\Controllers;

use App\Models\MlmPlan;
use Illuminate\Http\Request;

class MlmPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mlm_plans = MlmPlan::all();
        return response()->json($mlm_plans);
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
    public function show(MlmPlan $mlmPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MlmPlan $mlmPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MlmPlan $mlmPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MlmPlan $mlmPlan)
    {
        //
    }
}
