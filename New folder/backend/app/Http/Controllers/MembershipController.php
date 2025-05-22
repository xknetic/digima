<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $memberships = Membership::all();
        return response()->json($memberships);
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

        Membership::create($request->all());
        return response()->json("Membership Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        //
        return $membership;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership, $membership_id)
    {
        //
        $validatedData = $request->validate([
            'membership_name' => 'required',
            'hierarchy' => ''
        ]);

        $membership = Membership::updateOrCreate(
            ['membership_id' => $membership_id],
            $validatedData
        );

        dd($membership->membership_id);

        foreach ($memberships->membership_id as $m) {

        }
        

        return response()->json($membership);

        // dd($membership);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership, $membership_id)
    {
        //
        $membership = Membership::findOrFail($membership_id);

        $membership->archive = true;
        $membership->save();

        return response()->json($membership);
        dd($membership);
    }
}
