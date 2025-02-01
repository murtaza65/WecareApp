@extends('layouts.app')

@section('content')
				<div class="container goals-container">
								<h2 class="text-center wecare-logo">Goals & Progress</h2>

								<div class="list-group">
												@foreach ($goals as $index => $goal)
																<div class="goal-item" onmouseover="goalHovered({{ $index }})"
																				onmouseleave="goalLeft({{ $index }})">
																				<div class="goal-info">
																								<i class="{{ $goal['icon'] }}" class="goal-icon"></i>
																								<span class="goal-name">{{ $goal['name'] }}</span>
																				</div>

																				<!-- Progress Bar and Editable Progress -->
																				<div class="progress goal-progress">
																								<div class="progress-bar"
																												style="width: {{ $goal['progress'] }}%; transition: width 0.8s ease-in-out" role="progressbar"
																												aria-valuenow="{{ $goal['progress'] }}" aria-valuemin="0" aria-valuemax="100">
																												{{ $goal['progress'] }}%
																								</div>
																				</div>
																				<div class="progress-input">
																								<input type="number" min="0" max="100" class="form-control mt-2"
																												name="progress[{{ $index }}]" value="{{ old('progress.' . $index, $goal['progress']) }}"
																												onchange="updateProgress({{ $index }})" />
																				</div>

																				<!-- Like, Comment, and Delete buttons -->
																				<div class="goal-actions">
																								<button onclick="toggleLike({{ $index }})" class="btn btn-light btn-sm">
																												<i class="{{ $goal['liked'] ? 'fas fa-heart' : 'far fa-heart' }}"></i>
																								</button>
																								<button onclick="deleteGoal({{ $index }})" class="btn btn-danger btn-sm">Delete</button>
																				</div>

																				<!-- Comment Section -->
																				@if ($goal['showComments'])
																								<div>
																												<form method="POST" action="{{ route('goals.addComment', $goal['id']) }}">
																																@csrf
																																<input type="text" class="form-control mt-2" placeholder="Add a comment..."
																																				name="newComment" />
																																<button type="submit" class="btn btn-primary btn-sm mt-2">Add Comment</button>
																												</form>

																												@if (count($goal['comments']) > 0)
																																<div class="mt-3">
																																				<ul class="list-group">
																																								@foreach ($goal['comments'] as $comment)
																																												<li class="list-group-item">{{ $comment }}</li>
																																								@endforeach
																																				</ul>
																																</div>
																												@endif
																								</div>
																				@endif
																</div>
												@endforeach
								</div>

								<!-- Add Goal Button -->
								<a href="{{ route('goals.create') }}" class="btn btn-success btn-lg mt-4">Add New Goal</a>
				</div>

				<script>
								// JavaScript for handling progress input
								function updateProgress(index) {
												let input = document.querySelectorAll('.progress-input input')[index];
												let progress = input.value;
												if (progress < 0) progress = 0;
												if (progress > 100) progress = 100;
												input.value = progress;
												// Make an AJAX request to update progress in the backend, if necessary
								}

								function toggleLike(index) {
												// Handle like button click (AJAX or other logic here)
								}

								function deleteGoal(index) {
												// Handle goal deletion (AJAX or form submission here)
								}
				</script>
@endsection




public function index()
{
$goals = Goal::with('comments')->get();
return view('goals.index', compact('goals'));
}

public function toggleLike($id)
{
$goal = Goal::find($id);
$goal->liked = !$goal->liked;
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
