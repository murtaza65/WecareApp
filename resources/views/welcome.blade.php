@extends('layouts.welcome')
@section('content')
				<section class="web">
								<!DOCTYPE html>
								<html lang="en">

								<head>
												<meta charset="UTF-8">
												<meta name="viewport" content="width=device-width, initial-scale=1.0">
												<title>WeCare</title>
												<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
												<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
												<style>
																.wecare-logo {
																				font-size: 28px;
																				font-weight: bold;
																				color: white !important;
																}

																.nav-link {
																				font-size: 18px;
																}

																.nav-link:hover {
																				text-decoration: underline;
																}

																.nav-link.item {
																				text-decoration: none;
																}

																body {
																				background-color: black;
																				color: white;
																}

																.card {
																				cursor: pointer;
																				background-color: white;
																}

																.card:hover {
																				background-color: #f8f9fa;
																}
												</style>
								</head>

								<body>
												<div class="container text-center mt-5">
																<div class="text-white text-center">
																				@if (auth()->user())
																								<h1 class="fw-bold">Hi, {{ auth()->user()->username }}</h1>
																				@endif

																</div>
																<div class="row justify-content-center mt-4">
																				<div class="col-4 col-md-2 text-center">
																								<a href="/goals" class="btn btn-light rounded-circle p-3 shadow">
																												<i class="fas fa-map-marker-alt fa-2x"></i>
																								</a>
																								<p class="mt-2">Your Goals & Progress</p>
																				</div>
																				<div class="col-4 col-md-2 text-center">
																								<a href="/reminders" class="btn btn-light rounded-circle p-3 shadow">
																												<i class="fas fa-bell fa-2x"></i>
																								</a>
																								<p class="mt-2">Reminders</p>
																				</div>
																				<div class="col-4 col-md-2 text-center">
																								<a href="/community" class="btn btn-light rounded-circle p-3 shadow">
																												<i class="fas fa-users fa-2x"></i>
																								</a>
																								<p class="mt-2">Community Support</p>
																				</div>
																</div>
																<div class="row justify-content-center mt-4">
																				<div class="col-md-6">
																								<a href="/chat" class="nav-link item">
																												<div class="card shadow-sm p-3 mb-3">
																																<h4 class="fw-bold">AI Personal Assistant</h4>
																																<p>Ask or tell me anything, and I will remember!</p>
																												</div>
																								</a>
																				</div>
																				<div class="col-md-6">
																								<a href="/chat" class="nav-link item">
																												<div class="card shadow-sm p-3 mb-3">
																																<h4 class="fw-bold">Behavior Tracker & Analyzer</h4>
																																<p>Track and analyze your behaviors.</p>
																												</div>
																								</a>
																				</div>
																</div>
																<div class="card card-body mt-4">
																				<h5 class="text-white">User Progress Chart</h5>
																				<canvas id="progressChart"></canvas>
																</div>
												</div>

												<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
												<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
												<script>
																document.addEventListener("DOMContentLoaded", function() {
																				const ctx = document.getElementById("progressChart").getContext("2d");
																				new Chart(ctx, {
																								type: "line",
																								data: {
																												labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5"],
																												datasets: [{
																																label: "Progress",
																																data: [40, 90, 0, 60, 10],
																																borderColor: "blue",
																																fill: false,
																												}],
																								},
																								options: {
																												responsive: true
																								}
																				});
																});
												</script>
								</body>

								</html>

				</section>
@endsection
