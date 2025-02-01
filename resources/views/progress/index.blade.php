@extends('layouts.app')

@section('content')
				<div class="container goals-container">
								<h2 class="text-center wecare-logo">Goals & Progress</h2>

								<div class="list-group">
												@foreach ($goals as $index => $goal)
																<div class="goal-item">
																				<div class="goal-info">
																								<i class="{{ $goal->icon }} goal-icon"></i>
																								<span class="goal-name">{{ $goal->name }}</span>
																				</div>

																				<!-- Progress Bar -->
																				<div class="progress goal-progress">
																								<div class="progress-bar" style="width: {{ $goal->progress }}%; transition: width 0.8s ease-in-out"
																												role="progressbar" aria-valuenow="{{ $goal->progress }}" aria-valuemin="0" aria-valuemax="100">
																												{{ $goal->progress }}%
																								</div>
																				</div>

																				<!-- Input to update progress -->
																				<div class="progress-input">
																								<input type="number" name="progress[{{ $goal->id }}]" min="0" max="100"
																												value="{{ $goal->progress }}" class="form-control mt-2" />
																				</div>

																				<!-- Goal Actions (Like, Comment, Delete) -->
																				<div class="goal-actions">
																								<form method="POST" action="{{ route('goals.toggleLike', $goal->id) }}">
																												@csrf
																												<button type="submit" class="btn btn-light btn-sm">
																																<i class="{{ $goal->liked ? 'fas fa-heart' : 'far fa-heart' }}"></i>
																												</button>
																								</form>
																								<form method="POST" action="{{ route('goals.delete', $goal->id) }}">
																												@csrf
																												@method('DELETE')
																												<button type="submit" class="btn btn-danger btn-sm">Delete</button>
																								</form>
																				</div>

																				<!-- Comment Section -->
																				<div class="comment-section">
																								<form method="POST" action="{{ route('goals.addComment', $goal->id) }}">
																												@csrf
																												<input type="text" name="new_comment" class="form-control mt-2"
																																placeholder="Add a comment..." />
																												<button type="submit" class="btn btn-primary btn-sm mt-2">
																																Add Comment
																												</button>
																								</form>

																								@if ($goal->comments->isNotEmpty())
																												<div class="mt-3">
																																<ul class="list-group">
																																				@foreach ($goal->comments as $comment)
																																								<li class="list-group-item">{{ $comment->text }}</li>
																																				@endforeach
																																</ul>
																												</div>
																								@endif
																				</div>
																</div>
												@endforeach
								</div>

								<!-- Add Goal Button -->
								<a href="{{ route('goals.create') }}" class="btn btn-success btn-lg mt-4">Add New Goal</a>
				</div>
@endsection

@section('styles')
				<style scoped>
								/* Dark theme background */
								body {
												background-color: black;
												color: white;
								}

								/* Goals Container */
								.goals-container {
												max-width: 800px;
												padding: 20px;
												margin-top: 30px;
												border-radius: 10px;
												box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
								}

								/* Goal Item */
								.goal-item {
												background: #282828;
												padding: 15px;
												border-radius: 10px;
												margin-bottom: 15px;
												display: flex;
												justify-content: space-between;
												align-items: center;
												transition: transform 0.3s ease;
								}

								.goal-item:hover {
												transform: scale(1.05);
								}

								.goal-info {
												display: flex;
												align-items: center;
								}

								.goal-icon {
												font-size: 30px;
												margin-right: 15px;
												color: white;
								}

								.goal-name {
												font-size: 18px;
												color: white;
								}

								/* Progress Bar */
								.progress {
												background-color: #343a40;
												border-radius: 50px;
												height: 10px;
												width: 100%;
								}

								.progress-bar {
												height: 100%;
												background-color: #28a745;
												border-radius: 50px;
												text-align: center;
												line-height: 10px;
												color: white;
												font-weight: bold;
												transition: width 0.8s ease-in-out;
								}

								/* Input for Progress */
								.progress-input input {
												width: 60px;
												margin-top: 10px;
												border-radius: 5px;
								}

								/* Hover Effects */
								.goal-item:hover .goal-name {
												color: #f8f9fa;
								}

								.goal-item:hover .progress-bar {
												background-color: #ffc107;
								}

								.goal-actions {
												display: flex;
												gap: 10px;
												margin-top: 10px;
								}

								.goal-actions button {
												border-radius: 50px;
								}

								.goal-actions button i {
												font-size: 18px;
								}

								.add-goal-btn {
												width: 100%;
												background-color: #28a745;
												color: white;
												font-size: 16px;
												border-radius: 50px;
								}

								.add-goal-btn:hover {
												background-color: #218838;
								}

								.comment-section {
												margin-top: 10px;
								}

								.comment-section input {
												width: 100%;
								}
				</style>
@endsection
