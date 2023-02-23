<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		body {
			background-color: #f8f9fa;
		}
		.login-form {
			margin: auto;
			margin-top: 10%;
			max-width: 500px;
			padding: 50px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}
		.login-form input[type="text"], .login-form input[type="password"] {
			margin-top: 20px;
			padding: 10px;
			border-radius: 3px;
			border: none;
			background-color: #f8f9fa;
			box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
		}
		.login-form input[type="submit"] {
			margin-top: 30px;
			padding: 10px;
			border-radius: 3px;
			border: none;
			background-color: #007bff;
			color: #fff;
			cursor: pointer;
			transition: background-color 0.2s ease-in-out;
		}
		.login-form input[type="submit"]:hover {
			background-color: #0069d9;
		}
		.login-form a {
			display: block;
			margin-top: 20px;
			color: #007bff;
			text-align: center;
			transition: color 0.2s ease-in-out;
		}
		.login-form a:hover {
			color: #0069d9;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<form class="login-form">
					<h1 class="h3 mb-3 font-weight-normal">Login</h1>
					<label for="inputEmail">Email address</label>
					<input type="text" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
					<label for="inputPassword">Password</label>
					<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
					<a href="#">Forgot password?</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
