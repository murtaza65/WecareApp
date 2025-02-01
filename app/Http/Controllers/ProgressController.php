<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProgressRequest;
use App\Http\Requests\UpdateProgressRequest;
use App\Models\Goal;
use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
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
    public function store(StoreProgressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Progress $progress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgressRequest $request, Progress $progress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        //
    }

    public function toggleLike($id)
    {
        $goal        = Goal::find($id);
        $goal->liked = ! $goal->liked;
        $goal->save();

        return redirect()->route('goals.index');
    }

    public function deleteGoal($id)
    {
        $goal = Goal::find($id);
        $goal->delete();

        return redirect()->route('goals.index');
    }

    public function addComment(Request $request, $id)
    {
        $goal = Goal::find($id);
        $goal->comments()->create(['text' => $request->new_comment]);

        return redirect()->route('goals.index');
    }

}
