<?php
	session_start();
		
	if(!(isset($_SESSION["login"]) && $_SESSION["login"] != '')){
		header("Location: login.php");
	}
	
	require_once 'includes\user.php';
	require_once 'includes\blog.php';
	require_once 'includes\config.php';
	
	$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		
	if(isset($_GET['id'])){
		deletePost($db_found);
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
			<link href="static/css/style.css" rel="stylesheet">
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
			<div id="content" class="row">
				<div id="sidebar" class="span2">
					<ul id="sidebar-list" class="nav nav-list">
						<li>
							<p>
							<form id="create-form" method="get" action="post.php">
							<a href="post.php?type=create" class="btn btn-primary btn-block">New Post</a>
							</form>
							</p>
						</li>
						<li>
							<p>
							<input type="button btn-primary btn-block" value="Post List" onClick="javascript:showPosts();" class="btn btn-primary" id="edit-posts">
							</p>
						</li>
						<li>
							<p>
							<form id="logout-form" action="dashboard.php" method="post"> 
								<button class="btn btn-primary btn-block" type="submit" name="logout">Log Out</button>
							</form>
							</p>
						</li>
					</ul>
				</div>
				<div id="main" class="span6">
					<p>
						<?php echo "Hello, ".$_SESSION['username']."."; ?>
					</p>
					<p>
						<table id="postsTable" class="table table-bordered" style="display:none;">
							<tr>
								<td><strong>Post Title</strong></td>
								<td><strong>Date Posted</strong></td>
								<td><strong>Edit</strong></td>
								<td><strong>Delete</strong></td>
							</tr>
							<?php
								listPosts($db_found);
							?>
						</table>
					</p>
				</div>
			</div>
		</div>
		</body>
	</html>