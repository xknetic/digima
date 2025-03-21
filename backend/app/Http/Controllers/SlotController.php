<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $slots = Slot::with(['users', 'memberships', 'sponsor_info'])->get();
        // dd($slots);
        return response()->json($slots);
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
        // Create User
        $request->validate([
            // 'name' => 'required',
            // 'email' => 'required',
            // 'password' => 'required',
            // 'first_name' => 'required',
            // 'middle_name' => 'required',
            // 'last_name' => 'required',
        ]);
        $users = $request->only([
            'first_name', 
            'middle_name', 
            'last_name', 
            'email', 
            'password', 
        ]);
 
        // User Data
        $user = User::create($users);

        $slots = $request->only([
            'slot_username', 
            'slot_sponsor', 
            'slot_user_id',
        ]);

        $slots['slot_user_id'] = $user->id;

        // sponsor username
        $slots['slot_sponsor'] = Slot::where("slot_username", $slots['slot_sponsor'])->first() ? Slot::where("slot_username", $slots['slot_sponsor'])->first()->slot_id : null;

        Slot::create($slots);
        
        return response()->json("Slot Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Slot $slot)
    {
        //
        return $slot;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slot $slot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slot $slot)
    {
        //
        $request->validate([

        ]);
        $users = $request->only([
            'first_name', 
            'middle_name', 
            'last_name', 
            'email', 
            'password', 
        ]);
 
        // User Data
        $user = User::create($users);

        $slots = $request->only([
            'slot_username', 
            'slot_sponsor', 
            'slot_user_id',
        ]);

        $slots['slot_user_id'] = $user->id;

        // sponsor username
        $slots['slot_sponsor'] = Slot::where("slot_username", $slots['slot_sponsor'])->first() ? Slot::where("slot_username", $slots['slot_sponsor'])->first()->slot_id : null;

        Slot::create($slots);
        
        return response()->json("Slot Created");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slot $slot)
    {
        //
    }
}
