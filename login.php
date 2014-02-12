<?php
	session_start();

	if(isset($_SESSION["login"]) && $_SESSION["login"] != ''){
		header("Location: dashboard.php");
	}
	
	require_once 'includes\user.php';
	require_once 'includes\config.php';
	
	$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$errorMessage = '';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['login'])){
			$errorMessage = validateLogin($db_found);
		}
		elseif(isset($_POST['signup'])){
			$errorMessage = signUp($db_found);
		}		
	}
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<?php
				include "common\header.php";
			?>
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