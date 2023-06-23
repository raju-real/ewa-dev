<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link rel="stylesheet" href="{{ asset('assets/backend/vendors/core/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/backend/css/demo_5/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/backend/images/favicon.png') }}" />
</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                                <div class="col-md-4 pr-md-0">
                                  <div class="auth-left-wrapper" style="background-image: url({{ asset('assets/frontend/img/login-page.jpg') }})">

                                  </div>
                                </div>
                                <div class="col-md-8 pl-md-0">
                                  <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2"><span>Engineers Welfare Association</span></a>
                                    <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                                      @if(Session::has('message'))
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              <strong>{{ Session::get('message') }}</strong>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                      @endif
                                    <form class="forms-sample" action="{{ route('user-login') }}" method="POST">
                                        @csrf
                                      <div class="form-group">
                                        <label>Email/Mobile</label> {!! starSign() !!}
                                        <input type="text" name="email_mobile" value="{{ old('email_mobile') }}" class="form-control @error('email_mobile') is-invalid @enderror" placeholder="Email/Mobile">
                                          @error('email_mobile')
                                                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong></span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label> {!! starSign() !!}
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Password">
                                          @error('password')
                                                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong></span>
                                          @enderror
                                      </div>
                                      <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                          <input type="checkbox" name="remember" class="form-check-input">
                                          Remember me
                                        </label>
                                      </div>
                                      <div class="mt-3">
                                        <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">Login</button>
                                      </div>
                                      <a href="{{ route('home') }}" class="d-block mt-3 text-muted">Back To Home</a>
                                    </form>
                                  </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<script src="{{ asset('assets/backend/vendors/core/core.js') }}"></script>
	<script src="{{ asset('assets/backend/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/template.js') }}"></script>
</body>
</html>
