<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Inventory;
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
        $request->validate([]);
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
            'slot_membership_id',
            // 'code_id',
        ]);

        // dd($slots);

        $slots['slot_user_id'] = $user->id;

        // sponsor username
        $slots['slot_sponsor'] = Slot::where("slot_username", $slots['slot_sponsor'])->first() ? Slot::where("slot_username", $slots['slot_sponsor'])->first()->slot_id : null;

        // if ($request->has('code_id')) {
        //     
        //     $slots['slot_membership_id'] = $codes->inventories->items->membership_id;
        //     // dd($codes->inventories->items->membership_id);
        // }

        $slot = Slot::create($slots);

        if ($request->has('code_id')) {
            $request['slot_id'] = $slot->slot_id;
            $request['slot_sponsor'] = $request->input('slot_sponsor');
            $codes = Code::with(['inventories.items'])->where('code_id', $request->input('code_id'))->first();
            $request['slot_membership_id'] = $codes->inventories->items->membership_id;
            $this->generateCode($request, $request->input('code_id'));
        }

        return response()->json("Slot Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Slot $slot)
    {
        //
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
        // $request->validate([

        // ]);
        // $users = $request->only([
        //     'first_name', 
        //     'middle_name', 
        //     'last_name', 
        //     'email', 
        //     'password', 
        // ]);

        // // User Data
        // $user = User::create($users);

        // $slots = $request->only([
        //     'slot_username', 
        //     'slot_sponsor', 
        //     'slot_user_id',
        // ]);

        // $slots['slot_user_id'] = $user->id;

        // // sponsor username
        // $slots['slot_sponsor'] = Slot::where("slot_username", $slots['slot_sponsor'])->first() ? Slot::where("slot_username", $slots['slot_sponsor'])->first()->slot_id : null;

        // Slot::create($slots);

        // return response()->json("Slot Created");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slot $slot)
    {
        //
    }

    public function generateCode(Request $request, $code_id)
    {
        //
        $slot = Slot::where('slot_id', $request->input('slot_id'))->first();
        // dd($request);
        $code = Code::findOrFail($code_id);

        // Convert the string into the slot_id based on the slot_username
        $slotSponsor = $request->input('slot_sponsor');
        $sponsorSlot = Slot::where('slot_username', $slotSponsor)->first();

        // If the sponsor slot exists, get the slot_id; otherwise, default to null or handle the error
        $slotSponsorId = $sponsorSlot->slot_id;

        $request->validate([
            // Validation Fields
        ]);

        // dd($request);
        if ($slot->slot_membership_id == null) {
            $slot->update([
                'slot_sponsor' => $slotSponsorId,
                'slot_membership_id' => $request->input('slot_membership_id'),
            ]);
        } else {
            // Create
            // Count Slot
            $countSlot = Slot::where('slot_user_id', $slot->slot_user_id)->count();
            // dd($existingSlot);

            // Count Slot
            if ($countSlot) {
                $slot->slot_username .= '-' . $countSlot + 1;
            }

            $slots = [
                'slot_username' => $slot->slot_username,
                'slot_sponsor'  => $slotSponsorId,
                'slot_user_id'  => $slot->slot_user_id,
                'slot_membership_id' => $request->input('slot_membership_id'),
            ];

            $newSlot = Slot::create($slots);
        }
        $code->update([
            'code_sold_to' => $slot->slot_user_id,
            'code_used_by' => $slot->slot_user_id,
        ]);

        $inventory = $code->inventories()->first();
        if ($inventory) {
            $inventory->inventory_quantity -= 1;
            $inventory->inventory_sold += 1;
            
            $inventory->save();
        }

        return response()->json([$slot, $code]);
    }
}
