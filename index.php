<?php
	require_once 'includes\blog.php';
	require_once 'includes\config.php';

	session_start();

	$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<?php
				include "common\header.php";
			?>
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