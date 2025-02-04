@extends('layouts.app')

@section('content')
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
				<div class="container goals-container">
								<h2 class="text-center wecare-logo">Goals & Progress</h2>

								<!-- Goals List -->
								<div class="list-group">
												@foreach ($goals as $goal)
																<div class="goal-item">
																				<div class="goal-info">
																								<i class="{{ $goal->icon }} goal-icon"></i>
																								<span>{{ $goal->title }}</span>
																				</div>
																				<div class="progress goal-progress ">
																								<div class="progress-bar" style="width: {{ $goal->progress }}%" role="progressbar"
																												aria-valuenow="{{ $goal->progress }}" aria-valuemin="0" aria-valuemax="100">
																												{{ $goal->progress }}%
																								</div>
																								<span class="text-dark">
																												{{ $goal->progress }}%
																								</span>
																				</div>

																</div>
												@endforeach
								</div>

								<!-- Reminders Section -->
								<h3 class="text-center mt-4">Reminders</h3>

								<!-- Button to Add Reminder -->
								<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reminderModal">Add Reminder</button>

								<table class="table table-dark table-striped reminders-table mt-3">
												<thead>
																<tr>
																				<th>#</th>
																				<th>Notification</th>
																				<th>Time</th>
																				<th>Actions</th>
																</tr>
												</thead>
												<tbody>
																@foreach ($reminders as $index => $reminder)
																				<tr>
																								<td>{{ $index + 1 }}</td>
																								<td>{{ $reminder->message }}</td>
																								<td>{{ $reminder->reminder_time }}</td>
																								<td>
																												<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reminderModal"
																																data-id="{{ $reminder->id }}" data-message="{{ $reminder->message }}"
																																data-time="{{ $reminder->time }}">Edit</button>
																												<button class="btn btn-danger btn-sm"
																																onclick="deleteReminder({{ $reminder->id }})">Delete</button>
																								</td>
																				</tr>
																@endforeach
												</tbody>
								</table>
				</div>

				<!-- Reminder Modal -->
				<div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
								<div class="modal-dialog">
												<div class="modal-content">
																<div class="modal-header">
																				<h5 class="modal-title" id="reminderModalLabel">Add/Edit Reminder</h5>
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																				<form id="reminderForm">
																								<input type="hidden" id="reminderId">
																								<div class="mb-3">
																												<label for="reminderMessage" class="form-label">Message</label>
																												<input type="text" class="form-control" id="reminderMessage" required>
																								</div>
																								<div class="mb-3">
																												<label for="reminderTime" class="form-label">Time</label>
																												<input type="time" class="form-control" id="reminderTime" required>
																								</div>
																								<button type="submit" class="btn btn-primary">Save Reminder</button>
																				</form>
																</div>
												</div>
								</div>
				</div>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

				<script>
								// Set up modal for editing reminder
								const reminderModal = new bootstrap.Modal(document.getElementById('reminderModal'), {
												keyboard: false
								});

								document.addEventListener('DOMContentLoaded', function() {
												// Set up form submit to either add or update reminder
												document.getElementById('reminderForm').addEventListener('submit', function(e) {
																e.preventDefault();

																const reminderId = document.getElementById('reminderId').value;
																const message = document.getElementById('reminderMessage').value;
																const time = document.getElementById('reminderTime').value;

																if (reminderId) {
																				// Edit reminder API call
																				axios.put(`/api/reminders/${reminderId}`, {
																												message,
																												time
																								})
																								.then(response => {
																												location.reload();
																								})
																								.catch(error => console.log(error));
																} else {
																				// Add reminder API call
																				axios.post('/api/reminders', {
																												message,
																												time,
																												goal_id,
																												user_id,
																								})
																								.then(response => {
																												location.reload();
																								})
																								.catch(error => console.log(error));
																}

																// Close modal
																reminderModal.hide();
												});

												// Set modal for editing reminder data
												$('#reminderModal').on('show.bs.modal', function(event) {
																const button = $(event.relatedTarget);
																const id = button.data('id');
																const message = button.data('message');
																const time = button.data('time');

																document.getElementById('reminderId').value = id || '';
																document.getElementById('reminderMessage').value = message || '';
																document.getElementById('reminderTime').value = time || '';
												});
								});

								// Function to delete reminder
								function deleteReminder(id) {
												if (confirm('Are you sure you want to delete this reminder?')) {
																axios.delete(`/api/reminders/${id}`)
																				.then(response => {
																								location.reload();
																				})
																				.catch(error => console.log(error));
												}
								}
				</script>

				<style scoped>
								/* Additional Styles for Reminders */
								.reminders-table th,
								.reminders-table td {
												vertical-align: middle;
								}

								.reminders-table .btn {
												margin: 0 5px;
								}
				</style>
@endsection
