<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Models\Reminder;

class ReminderControllerAPI extends BaseController
{
    /**
     * Display a listing of the reminders.
     */
    public function index()
    {
        // Fetch all reminders
        $reminders = Reminder::all();

        // Return reminders in a JSON format for API response
        return response()->json($reminders);
    }

    /**
     * Store a newly created reminder in storage.
     */
    public function store(StoreReminderRequest $request)
    {
        // Validate and store reminder
        $reminder = Reminder::create([
            'message'       => $request->message,
            'reminder_time' => $request->time,
            'goal_id'       => $request->goal_id,
            'user_id'       => $request->user_id,
        ]);

        // Return the newly created reminder as a JSON response
        return response()->json($reminder, 201);
    }

    /**
     * Display the specified reminder.
     */
    public function show(Reminder $reminder)
    {
        // Return specific reminder as a JSON response
        return response()->json($reminder);
    }

    /**
     * Update the specified reminder in storage.
     */
    public function update(UpdateReminderRequest $request, Reminder $reminder)
    {
        // Update reminder fields
        $reminder->update([
            'message'       => $request->message,
            'reminder_time' => $request->time,
        ]);

        // Return the updated reminder
        return response()->json($reminder);
    }

    /**
     * Remove the specified reminder from storage.
     */
    public function destroy(Reminder $reminder)
    {
        // Delete the reminder
        $reminder->delete();

        // Return a success message
        return response()->json(['message' => 'Reminder deleted successfully']);
    }
}
