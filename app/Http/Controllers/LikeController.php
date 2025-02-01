<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request, Goal $goal)
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if the user has already liked the goal
        if ($user->likes->contains($goal)) {
            // If the goal is already liked, remove the like (unlike)
            $user->likes()->detach($goal->id);
            return response()->json(['message' => 'Goal unliked successfully', 'liked' => false]);
        } else {
            // Otherwise, add the like
            $user->likes()->attach($goal->id);
            return response()->json(['message' => 'Goal liked successfully', 'liked' => true]);
        }
    }
}
