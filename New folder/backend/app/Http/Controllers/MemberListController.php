<?php

namespace App\Http\Controllers;

use App\Models\MemberList;
use Illuminate\Http\Request;

class MemberListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return response()->json("MemberList Index");
        $memberlists = MemberList::all();
        return response()->json($memberlists);
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

        MemberList::create($request->all());
        return response()->json("MemberList Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberList $memberList)
    {
        //
        return $memberList;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberList $memberList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MemberList $memberList, $id)
    {
        //
        $memberList = MemberList::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            // 'email' => 'required|string',
        ]);

        $memberList->update($request->all());

        return response()->json($memberList);

        
        // $memberList->update($request->validate());
        // return response()->json('Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $memberList = MemberList::findOrFail($id);
        $memberList->delete();

        return response()->json(null, 204);
    }
}
