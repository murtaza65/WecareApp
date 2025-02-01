<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Models\Goal;

class GoalController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = $this->user()->goals; // Get goals for the authenticated user
        return view('goals.index', compact('goals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('goals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoalRequest $request)
    {
        $goal = $this->user()->goals()->create($request->validated());
        return redirect()->route('goals.index')->with('success', 'Goal created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        $this->authorize('view', $goal); // Ensure user owns the goal
        return view('goals.show', compact('goal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);
        return view('goals.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalRequest $request, Goal $goal)
    {
        $this->authorize('update', $goal);
        $goal->update($request->validated());
        return redirect()->route('goals.index')->with('success', 'Goal updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);
        $goal->delete();
        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully!');
    }
}
