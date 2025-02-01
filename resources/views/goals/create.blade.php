@extends('layouts.app')

@section('content')
				<div class="py-4">


								<div class="container goal-add-container bg-dark text-white p-4 rounded shadow-lg ">
												<h2 class="text-center wecare-logo mb-4">Add New Goal</h2>

												<form action="{{ route('goals.store') }}" method="POST">
																@csrf

																<div class="form-group">
																				<label for="goalName">Goal Name</label>
																				<input type="text" name="title" id="goalName" class="form-control bg-secondary text-white border-0"
																								placeholder="Enter goal name" required />
																</div>

																<div class="form-group">
																				<label for="goalIcon">Goal Icon</label>
																				<select name="icon" id="goalIcon" class="form-control bg-secondary text-white border-0" required>
																								<option value="fas fa-spa">Meditation</option>
																								<option value="fas fa-dumbbell">Exercise</option>
																								<option value="fas fa-apple-alt">Healthy Eating</option>
																								<option value="fas fa-book">Reading</option>
																				</select>
																</div>

																<div class="form-group">
																				<label for="goalProgress">Goal Progress (%)</label>
																				<input type="number" name="progress" id="goalProgress"
																								class="form-control bg-secondary text-white border-0" min="0" max="100" required />
																</div>

																<div class="form-group">
																				<label for="goalDescription">Goal Description</label>
																				<textarea name="description" id="goalDescription" class="form-control bg-secondary text-white border-0"
																				    placeholder="Add a brief description of the goal"></textarea>
																</div>

																<div class="text-center mt-4">
																				<button type="submit" class="btn btn-success btn-lg px-4">Add Goal</button>
																				<a href="{{ route('goals.index') }}" class="btn btn-danger btn-lg mx-4 px-4">Cancel</a>
																</div>
												</form>
								</div>
				</div>
@endsection
