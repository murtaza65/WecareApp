@extends('layouts.login')
@section('content')
				<section class="material-half-bg bg-dark">
								<div class="cover"></div>
				</section>
				<section class="login-content ">
								<div class="logo m-3 text-light">
												<h1><strong>{{ config('app.name') }}</strong></h1>
								</div>
								<div class="login-box bg-secondary">
												<!--login form-->
												<form class="login-form" method="POST" action="{{ route('login') }}">
																@csrf

																<h3 class="login-head"><i class="fa fa-user fa-lg fa-2x"></i>SIGN IN</h3>
																<div class="form-group">
																				<label class="control-label text-light">Email</label>
																				<div class="col">
																								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
																												name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

																								@error('email')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>
																</div>
																<div class="form-group">
																				<label class="control-label text-light">PASSWORD</label>
																				<div class="col">
																								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
																												name="password" required autocomplete="current-password">

																								@error('password')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>
																</div>
																<div class="form-group">
																				<div class="utility">
																								<div class="animated-checkbox ">
																												<label>
																																<input class="form-check-input" type="checkbox" name="remember" id="remember"
																																				{{ old('remember') ? 'checked' : '' }}>
																																<span class="label-text text-light">Stay Signed in</span>
																												</label>
																								</div>
																								<p class="semibold-text text-light mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a>
																								</p>
																				</div>
																</div>
																<div class="form-group btn-container">
																				<div class="col">
																								<button type="submit" class="btn btn-outline-dark btn-block"> SIGN IN <i
																																class="fa fa-solid fa-right-to-bracket fa-lg fa-fw"></i>
																								</button>

																								<p class="semibold-text m-3"><a href="{{ route('register', 'role=1') }}">Or Register to be a
																																member</a></p>

																				</div>
																</div>
												</form>
												<!--forgot password form-->
												<form class="forget-form" method="POST" action="{{ route('password.email') }}">
																@csrf
																<h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
																<div class="form-group">

																				<input type="hidden" name="token" value="{{ $token ?? 'guest' }}">

																				<label class="control-label text-light">EMAIL</label>
																				<input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
																								placeholder="Email" name="email" value="{{ $email ?? old('email') }}" required
																								autocomplete="email" autofocus>

																				@error('email')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror

																</div>
																<div class="form-group btn-container">
																				<button class="btn btn-primary btn-block" type="submit"><i
																												class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
																</div>
																<div class="form-group mt-3">
																				<p class="semibold-text mb-0"><a href="/login" data-toggle="flip"><i
																																class="fa fa-angle-left fa-fw"></i>
																												Back to Login</a></p>
																</div>
												</form>
								</div>
				</section>
@endsection
