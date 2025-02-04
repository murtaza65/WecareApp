<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Models\Goal;
use App\Models\Reminder;

class ReminderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Goal $goal = null)
    {
        $goals     = $this->user()->goals;
        $reminders = $this->user()->reminders;

        if ($goal) { //
            $goals     = Goal::where('id', $goal->id)->get();
            $reminders = $goal->reminders;
        }

        return view('reminders.index', compact('goal', 'goals', 'reminders'));
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
    public function store(StoreReminderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reminder $reminder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reminder $reminder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReminderRequest $request, Reminder $reminder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        //
    }
}
