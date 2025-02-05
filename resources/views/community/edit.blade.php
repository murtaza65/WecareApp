@extends('layouts.app')

@section('content')
				<div class="container">
								<h2 class="text-center">Manage Your Community</h2>

								<!-- List of all users -->
								<div class="row">
												<div class="col-md-6">
																<h3>Select Users to Add to Community</h3>
																<ul class="list-group" id="users-list">
																				@foreach ($users as $user)
																								<li class="list-group-item d-flex justify-content-between align-items-center">
																												{{ $user->name }}
																												<button class="btn btn-success add-member-btn" data-user-id="{{ $user->id }}">
																																Add
																												</button>
																								</li>
																				@endforeach
																</ul>
												</div>

												<!-- List of community members -->
												<div class="col-md-6">
																<h3>Community Members</h3>
																<ul class="list-group" id="community-members-list">
																				@foreach ($communityMembers as $member)
																								<li class="list-group-item d-flex justify-content-between align-items-center"
																												data-user-id="{{ $member->id }}">
																												{{ $member->name }}
																												<button class="btn btn-danger remove-member-btn">
																																Remove
																												</button>
																								</li>
																				@endforeach
																</ul>
												</div>
								</div>
				</div>

				@push('scripts')
								<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
								<script>
												document.addEventListener('DOMContentLoaded', function() {
																// Add community member
																document.querySelectorAll('.add-member-btn').forEach(button => {
																				button.addEventListener('click', function() {
																								const userId = this.getAttribute('data-user-id');

																								// Make AJAX call to add member
																								axios.post('/community/add-member', {
																																user_id: userId
																												})
																												.then(response => {
																																alert(response.data.message);
																																// Reload the community list
																																location
																												.reload(); // You can enhance this to update the list dynamically
																												})
																												.catch(error => {
																																console.error(error);
																												});
																				});
																});

																// Remove community member
																document.querySelectorAll('.remove-member-btn').forEach(button => {
																				button.addEventListener('click', function() {
																								const userId = this.closest('li').getAttribute('data-user-id');

																								// Make AJAX call to remove member
																								axios.post('/community/remove-member', {
																																user_id: userId
																												})
																												.then(response => {
																																alert(response.data.message);
																																// Reload the community list
																																location.reload(); // Again, consider dynamically updating the list
																												})
																												.catch(error => {
																																console.error(error);
																												});
																				});
																});
												});
								</script>
				@endpush
@endsection
