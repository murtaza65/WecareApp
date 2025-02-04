@extends('layouts.app')

@section('content')
				<div>
								<div class="container goal-container text-white">
												<h2 class="text-center mb-4">Goals & Progress</h2>

												<div class="list-group">
																@forelse($goals as $goal)
																				<div class="goal-item p-3 mb-3 bg-secondary border border-light rounded">
																								<div class="d-flex align-items-center">
																												<i class="{{ $goal->icon }} goal-icon fa-2x text-warning me-3"></i>
																												<h5 class="mb-0">{{ $goal->title }}</h5>
																								</div>

																								<p class="mt-2 text-light">{{ $goal->description }}</p>

																								<div class="progress bg-dark mb-2" style="height: 8px;">
																												<div class="progress-bar bg-success" style="width: {{ $goal->completed ? 100 : 0 }}%"></div>
																								</div>

																								<div class="d-flex justify-content-between">


																												<a href="{{ route('reminders.goals', $goal) }}" class="btn btn-outline-light btn-sm"><i
																																				class="fa fa-clock"></i> </a>
																												<form action="{{ route('likes.goals.store', ['goal' => $goal->id]) }}" method="POST"
																																class="d-inline">
																																@csrf
																																@method('POST')
																																<button type="submit" class="btn btn-outline-light btn-sm">
																																				@if ($goal->likes->count() > 0)
																																								<span class="text-danger"><i class="fa fa-heart"></i></span>
																																				@else
																																								<span><i class="far fa-heart"></i></span>
																																				@endif

																																</button>
																												</form>
																												<form action="{{ route('goals.destroy', $goal) }}" method="POST" class="d-inline">
																																@csrf
																																@method('DELETE')
																																<button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
																												</form>
																								</div>
																				</div>
																@empty
																				<div class="card card-body bg-secondary text-white text-center">
																								You have set no goals.
																				</div>
																@endforelse
												</div>

												<div class="text-center mt-4">
																<a href="{{ route('goals.create') }}" class="btn btn-success btn-lg">Add New Goal</a>
												</div>
								</div>
				</div>
@endsection
