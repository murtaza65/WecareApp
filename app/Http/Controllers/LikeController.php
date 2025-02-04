<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $goals = Goal::with('comments')->get();
        return view('goals.index', compact('goals'));
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
    public function store(Request $request, Goal $goal)
    {
        //

        // Get the authenticated user
        $user = $request->user();

        // Check if the user has already liked the goal

        if (! $user->likes->contains(function (Like $value) use ($goal) {
            return $value['goal_id'] == $goal->id;
        })) {
            // If the goal is already liked, remove the like (unlike)

            $user->likes()->create(["goal_id" => $goal->id])->save();
            return back()->with(['message' => 'Goal liked successfully', 'liked' => true]);

        } else {
            // Otherwise, add the like
            $like = Like::where('user_id', $user->id)->where('user_id', $user->id)->first();
            if ($like) {
                Like::destroy($like->id);
            }

            return back()->with(['message' => 'Goal unliked successfully', 'liked' => false]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }

    public function toggleLike(Request $request, $goal)
    {
    }
}
