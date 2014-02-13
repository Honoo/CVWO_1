<?php
	require_once 'includes/blog.php';
	require_once 'includes/config.php';

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
			<link href="static/css/style.css" rel="stylesheet">
			<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="static/js/bootstrap-button.js"></script>
			<script type="text/javascript" src="static/js/bootstrap-modal.js"></script>
			<script type="text/javascript" src="static/js/bootstrap-transition.js"></script>
			<script type="text/javascript" src="static/js/jquery.js"></script>
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
							if(!isset($_SESSION["login"])){
								echo '<a href="view/login.php">Login/Signup</a>';
							}
							else {
								echo '<a href="view/dashboard.php">Dashboard</a>';
							}
						?>
					</li>
				  </ul>
				</div> 
			</div>
			<!-- post display area -->
			<div id="posts-display">
				<?php
					if(isset($_REQUEST['author'])){
						displayPostsByAuthor($db_found);
					}
					else {
						displayPosts($db_found);
					}
				?>
			</div>
		</div>
		</body>
	</html>