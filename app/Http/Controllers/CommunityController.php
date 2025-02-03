<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\User;
use Illuminate\Http\Request;

class CommunityController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // Get all users (can filter by role or other criteria if needed)
        $users = User::all();

        // Assuming the logged-in user belongs to a community
        $community = $this->user()->communities()->first();

        // Get the members of the logged-in user's community
        $communityMembers = $community ? $community->members : [];
        return view('community.index', compact('users', 'communityMembers'));

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
    public function store(StoreCommunityRequest $request)
    {
        //

        $community = $this->user()->communities()->create(
            $request->validated()
        );

        // Get the members of the logged-in user's community
        $communityMembers = $community ? $community->members : [];
        return redirect('community.index')->with('success', 'The user' . '' . ' has been added to your community.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        //
    }

    // app/Http/Controllers/CommunityController.php

    public function addMember(Request $request)
    {
        $user      = User::findOrFail($request->user_id);
        $community = $this->user()->communities()->first();

        if ($community && ! $community->members->contains($user)) {
            $community->members()->attach($user);
        }

        return response()->json(['message' => 'Member added successfully!']);
    }

    public function removeMember(Request $request)
    {
        $user      = User::findOrFail($request->user_id);
        $community = $this->user()->communities()->first();

        return $community;

        if ($community && $community->members->contains($user)) {
            $community->members()->detach($user);
        }

        return response()->json(['message' => 'Member removed successfully!']);
    }

}
