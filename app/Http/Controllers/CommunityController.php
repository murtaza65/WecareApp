<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\User;

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
}
