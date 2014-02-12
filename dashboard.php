<?php
	require_once 'includes\user.php';
	require_once 'includes\blog.php';
	
	session_start();
		
	if(!(isset($_SESSION["login"]) && $_SESSION["login"] != '')){
		header("Location: login.php");
	}
		
	if(isset($_GET['id'])){
		deletePost();
	}
	
	if(isset($_POST["logout"])){
		logOut();
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
			<script type="text/javascript" src="static/ckeditor/ckeditor.js"></script>
			
			<script>				
				function showPosts() {
					$("#postsTable").show();
				}
			</script>
			
			<title>Dashboard</title>
		</head>
		<body>
		<div class="container-fluid">
			<div class="navbar">
				<div class="tabbable">
				  <ul class="nav nav-tabs">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="dashboard.php">Dashboard</a></li>
				  </ul>
				</div> 
			</div>
			<!-- Text editor -->
			<p>
				<form id="create-form" method="get" action="post.php">
					<a href="post.php?type=create" class="btn btn-primary">New Post</a>
				</form>
			</p>
			<!-- List of posts by user -->
			<a href="javascript:showPosts();" class="btn btn-primary" id="edit-posts">Edit/Delete Posts</a>
			<p><table id="postsTable" style="display:none;">
				<tr>
					<td>Post Title</td><td>Date Posted</td>
				</tr>
				<?php
					listPosts();
				?>
			</table></p>
			<!-- Logout button -->
			<form id="logout-form" action="dashboard.php" method="post"> 
				<button class="btn btn-primary" type="submit" name="logout">Log Out</button>
			</form>
		</div>
		</body>
	</html>