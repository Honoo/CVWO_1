<?php
	session_start();

	if(isset($_SESSION["login"]) && $_SESSION["login"] != ''){
		header("Location: dashboard.php");
	}
	
	require_once 'includes\user.php';
	
	$errorMessage = '';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
		$errorMessage = validateLogin();
	}
	elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])){
		$errorMessage = signUp();
	}
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="static/css/bootstrap.min.css" rel="stylesheet">
			<link href="static/css/bootstrap-responsive.min.css" rel="stylesheet">
			<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="static/js/bootstrap-button.js"></script>
			<script type="text/javascript" src="static/js/bootstrap-modal.js"></script>
			<script type="text/javascript" src="static/js/bootstrap-transition.js"></script>
			<script type="text/javascript" src="static/js/jquery-2.1.0.min.js"></script>
			<script type="text/javascript" src="static/js/jquery.md5.js"></script>
			<title>Login/Signup</title>
		</head>
		<body>
			<div class="container-fluid">
				<div class="navbar">
					<div class="tabbable">
					  <ul class="nav nav-tabs">
						<li><a href="index.php">Home</a></li>
						<li class="active"><a href="login.php">Login/Signup</a></li>
					  </ul>
					</div> 
				</div>
				<div class="container">
					<div id="error">
						<?php
							echo $errorMessage;
						?>
					</div>
					<div class="marketing"><h1>Log in and sign up here</h1>
						<!--<p class="marketing-byline">Create a new account or log in if you're already a trainer</p>-->
					</div>
					<div class="row-fluid">
						<!-- login box -->
						<div id="login-container" class="span6">
							<form id="login-form" action="login.php" method="post" class="well span12">
								<div class="modal-header">
									<a data-dismiss="modal" class="close"></a>
									<h3>Log In</h3>
								</div>
								<div class="modal-body">
									<fieldset>
									<div class="control-group">
										<input type="text" name="username" placeholder="Username" class="input-xlarge uname" maxlength="20">
										<span id="imagePlaceHolder"></span>
									</div>
									<div class="control-group">
										<input type="password" name="password" placeholder="Password" class="input-xlarge" maxlength="20">
									</div>
									</fieldset>
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary" type="submit" name="login">Log In</button>
								</div>
							</form>
						</div>
						<!-- signup box -->
						<div id="signup-container" class="span6">
							<form id="signup-form" action="login.php" method="post" class="well span12">
								<div class="modal-header">
									<a data-dismiss="modal" class="close"></a>
									<h3>Sign Up</h3>
								</div>
								<div class="modal-body">
									<fieldset>
										<div class="control-group">
											<input type="text" name="username" placeholder="Username" class="input-xlarge uname" maxlength="20">
											<span id="imagePlaceHolder"></span>
										</div>
										<div class="control-group">
											<input type="text" name="email" placeholder="Email" class="input-xlarge" maxlength="30">
										</div>
										<div class="control-group">
											<input type="password" name="password" placeholder="Password" class="input-xlarge" maxlength="20">
										</div>
									</fieldset>
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary create-button" type="submit" name="signup">Create Account</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</body>