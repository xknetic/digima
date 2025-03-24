<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Slot;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $codes = Code::with(['inventories.items', 'inventories.branches'])->get();
        // dd($codes);
        return response()->json($codes);
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

        // Arrange the string numbers to descending to get the first value
        $lastNumber = Code::orderBy('code_activation', 'desc')->first();

        // Check if the 0000001 if exisitng or not
        if ($lastNumber) {
            $lastCodeNumber = (int) substr($lastNumber->code_activation, 2);
            $nextCodeNumber = $lastCodeNumber + 1;
        } else {
            // increment if exist
            $nextCodeNumber = 1;
        }

        // Format the new code_activation
        $code_activation = 'LW' . str_pad($nextCodeNumber, 8, '0', STR_PAD_LEFT);

        // Generate the 8-digit code_pin
        do {
            $code_pin = rand(10000000, 99999999); // Generate a random 8-digit number
        } while (Code::where('code_pin', $code_pin)->exists());

        // Get all the request data and add the generated code_pin
        $generated = $request->all();
        $generated['code_activation'] = $code_activation;
        $generated['code_pin'] = $code_pin;

        Code::create($generated);
        return response()->json("Codes Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Code $code, $code_id)
    {
        //
        $slot = Slot::where('slot_id', $request->input('slot_id'))->first();
        $code = Code::findOrFail($code_id);

        // Convert the string into the slot_id based on the slot_username
        $slotSponsor = $request->input('slot_sponsor');
        $sponsorSlot = Slot::where('slot_username', $slotSponsor)->first();

        // If the sponsor slot exists, get the slot_id; otherwise, default to null or handle the error
        $slotSponsorId = $sponsorSlot->slot_id;

        $request->validate([
            // Validation Fields
        ]);

        $slot->update([
            'slot_sponsor' => $slotSponsorId,
        ]);

        $code->update([
            'code_sold_to' => $slot->slot_user_id,
            'code_used_by' => $slot->slot_user_id,
        ]);

        // Create
        // Get the previous slot_username (the one currently in use by the slot)
        $previousSlotUsername = $slot->slot_username;

        // Set the new slot_username based on the previous one, or use the input
        $newSlotUsername = $request->input('slot_username', $previousSlotUsername);

        // Check if the slot_username already exists in the database
        $existingSlot = Slot::where('slot_username', $newSlotUsername)->first();

        // If the username exists, append a number to it
        if ($existingSlot) {
            $count = 1;
            while (Slot::where('slot_username', $newSlotUsername . '-' . $count)->exists()) {
                $count++;
            }
            $newSlotUsername .= '-' . $count;
        }

        $slots = [
            'slot_username' => $newSlotUsername,
            'slot_sponsor'  => $slotSponsorId,
            'slot_user_id'  => $slot->slot_user_id,
        ];

        $newSlot = Slot::create($slots);

        return response()->json($newSlot);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Code $code)
    {
        //
    }
}
