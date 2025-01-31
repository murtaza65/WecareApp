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

				{{-- jquery --}}
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
				<!-- bootstrap -->
				<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

				<title>{{ env('APP_NAME') }}</title>
</head>

<body>
				<main>
								@yield('content')
				</main>
				<!-- Essential javascripts for application to work-->
				<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
				<script src="{{ asset('assets/js/popper.min.js') }}"></script>
				<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
				<script src="{{ asset('assets/js/main.js') }}"></script>
				<!-- The javascript plugin to display page loading on top-->
				<script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
				<script type="text/javascript">
								// Login Page Flipbox control
								$('.login-content [data-toggle="flip"]').click(function() {
												$('.login-box').toggleClass('flipped');
												return false;
								});
								$('.login-content [data-toggle="register-flip"]').click(function() {
												$('.register-box').toggleClass('register-flipped');
												return false;
								});
				</script>

				{{-- multiple select input box --}}


</body>

</html>
