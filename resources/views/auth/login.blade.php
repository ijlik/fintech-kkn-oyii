<!DOCTYPE html>
<html lang="en">
<head>
	<title>Aplikasi KKN Oyii</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/asset-login/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/asset-login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/css/util.css">
	<link rel="stylesheet" type="text/css" href="/asset-login/css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('/asset-login/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}
					<span class="login100-form-logo">
						<i class="zmdi zmdi-mood animated infinite wobble zmdi-hc-fw"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Aplikasi KKN Oyii
					</span>
          @if ($errors->has('username'))
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Waduh Error!</strong> {{ $errors->first('username') }}
            </div>
            @endif
          @if ($errors->has('password'))
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Waduh Error!</strong> {{ $errors->first('password') }}
            </div>
            @endif
          
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username" autocomplete="off" required>
						
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password" minlength="6" autocomplete="off" required>
						
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<script src="/asset-login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="/asset-login/vendor/animsition/js/animsition.min.js"></script>
	<script src="/asset-login/vendor/bootstrap/js/popper.js"></script>
	<script src="/asset-login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/asset-login/vendor/select2/select2.min.js"></script>
	<script src="/asset-login/vendor/daterangepicker/moment.min.js"></script>
	<script src="/asset-login/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="/asset-login/vendor/countdowntime/countdowntime.js"></script>
	<script src="/asset-login/js/main.js"></script>

</body>
</html>