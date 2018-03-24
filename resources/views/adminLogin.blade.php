<!DOCTYPE html>
<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Admin Login </title>

		<link href="{{ url('/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ url('/build/css/custom.min.css') }}" rel="stylesheet">

		<link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">

		<?php
		//<link rel="stylesheet" href="{{ mix('/bitty/admin.css') }}">
		?>

		<link href="{{ url('/bitty/main.css') }}" rel="stylesheet">

	</head>

	<body class="login">
		<div>
			<a class="hiddenanchor" id="signup"></a>
			<a class="hiddenanchor" id="signin"></a>

			<div class="login_wrapper">
				<div class="animate form login_form">
					<section class="login_content">
						<!-- <form> -->
						<form role="form" action="{{ url('adminLogin/loginDo') }}" method="post">
							<h1>Login</h1>
							<div>
								<input type="email" name="email" class="form-control" placeholder="Email" required="" />
							</div>
							<div>
								<input type="password" name="password" class="form-control" placeholder="Password" required="" />
							</div>
							<div>
								<!-- <a class="btn btn-primary submit" href="index.html">Log in</a> -->
								<button type="submit" class="btn btn-primary submit">
									Log in
								</button>
								<!-- <a class="reset_pass" href="#">Lost your password?</a> -->
							</div>

							<div class="clearfix"></div>

							<!-- <div class="separator">
							<p class="change_link">New to site?
							<a href="#signup" class="to_register"> Create Account </a>
							</p>

							<div class="clearfix"></div>
							<br />

							<div>
							<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
							<p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
							</div>
							</div> -->
						</form>
					</section>
				</div>

			</div>
		</div>
	</body>

</html>