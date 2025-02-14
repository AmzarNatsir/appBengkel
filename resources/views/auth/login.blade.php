<!doctype html>
<html lang="en">
  <head>
  	<title>Login - Pattallassang Variasi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('login_new/css/style.css') }}">
	</head>
	<body>
	<section class="ftco-section">
        <form action="{{ route('doLogin') }}" method="POST" class="login-form">
        @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex align-items-center justify-content-center mb-5">
                                <img src="{{ asset('assets/img/logo_asli.jpg') }}" style="width: 80%">
                            </div>
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-user-o"></span>
                            </div>
                            <h3 class="text-center mb-4">LOGIN</h3>

                            <div class="form-group">
                                <input id="email" type="email" class="form-control rounded-left @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email"  placeholder="Email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{!! session('messages') !!}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group d-flex">
                                <input id="password" type="password" class="form-control rounded-left @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! session('messages') !!}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Get Started</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</section>
<script src="{{ asset('login_new/js/jquery.min.js') }}"></script>
<script src="{{ asset('login_new/js/popper.js') }}"></script>
<script src="{{ asset('login_new/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('login_new/js/main.js') }}"></script>
</body>
</html>

