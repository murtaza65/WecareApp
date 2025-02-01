<!DOCTYPE html>
<html>

<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<!-- Main CSS-->
				<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
				<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
				<!-- Font-icon css-->
				<link rel="stylesheet" type="text/css"
								href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
								integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
								crossorigin="anonymous" referrerpolicy="no-referrer" />

				<style>
								body {
												background-color: #121212;
												color: #ffffff;
								}

								.login-box {
												background: #1e1e1e;
												padding: 20px;
												border-radius: 10px;
												box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
								}

								.btn-outline-dark {
												color: #ffffff;
												border-color: #ffffff;
								}

								.btn-outline-dark:hover {
												background-color: #ffffff;
												color: #121212;
								}

								a {
												color: #bb86fc;
								}

								a:hover {
												color: #ffffff;
								}

								.goal-container {
												max-width: 800px;
												margin: 30px auto;
												background: #1e1e1e;
												padding: 20px;
												border-radius: 10px;
								}

								.goal-item {
												background: #282828;
												padding: 15px;
												border-radius: 10px;
												margin-bottom: 15px;
												display: flex;
												justify-content: space-between;
												align-items: center;
								}

								.goal-icon {
												font-size: 30px;
												margin-right: 15px;
												color: white;
								}

								.progress-bar {
												height: 100%;
												background-color: #28a745;
												border-radius: 50px;
												text-align: center;
												line-height: 10px;
												color: white;
								}
				</style>

				{{-- jquery --}}
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
				<!-- bootstrap -->
				<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

				<title>{{ env('APP_NAME') }}</title>
</head>

<body>
				<main>
								{{--  @include('partials.topnav')  --}}
								<div class="container goal-container">
												<h2 class="text-center">Goals & Progress</h2>
												<div class="list-group">
																@foreach ($goals as $goal)
																				<div class="goal-item">
																								<div class="goal-info">
																												<i class="{{ $goal['icon'] }} goal-icon"></i>
																												<span class="goal-name">{{ $goal['name'] }}</span>
																								</div>
																								<div class="progress">
																												<div class="progress-bar" style="width: {{ $goal['progress'] }}%">{{ $goal['progress'] }}%
																												</div>
																								</div>
																								<div class="goal-actions">
																												<button class="btn btn-light btn-sm"><i class="far fa-heart"></i></button>
																												<button class="btn btn-danger btn-sm">Delete</button>
																								</div>
																				</div>
																@endforeach
												</div>
												<a href="/goals/add-goal" class="btn btn-success btn-lg mt-4">Add New Goal</a>
								</div>
				</main>
				<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
				<script src="{{ asset('assets/js/popper.min.js') }}"></script>
				<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
				<script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
