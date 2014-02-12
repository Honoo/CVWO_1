<?php
	require_once 'includes\blog.php';
	require_once 'includes\config.php';

	session_start();

	$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
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
			<title>My Blog Site</title>
		</head>
		<body>
		<div class="container-fluid">
			<div class="navbar">
				<div class="tabbable">
				  <ul class="nav nav-tabs">
					<li class="active"><a href="index.php">Home</a></li>
					<li>
						<?php 
							if(!(isset($_SESSION["login"]) && $_SESSION["login"] != '')) {
								echo '<a href="login.php">Login/Signup</a>';
							}
							else {
								echo '<a href="dashboard.php">Dashboard</a>';
							}
						?>
					</li>
				  </ul>
				</div> 
			</div>
			<div id="posts">
				<?php
					displayPosts($db_found);
				?>
			</div>
		</div>
		</body>
	</html>