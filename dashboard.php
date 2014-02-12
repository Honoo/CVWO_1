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
			<?php
				include "common\header.php";
			?>
			<script type="text/javascript" src="static/ckeditor/ckeditor.js"></script>
			
			<script>				
				function showPosts() {
					$("#tableSection").show();
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
				<!-- sidebar -->
				<div id="sidebar" class="span2">
					<ul id="sidebar-list" class="nav nav-list row-padded">
						<li>
							<form id="create-form" method="get" action="post.php">
							<a href="post.php?type=create" class="btn btn-primary btn-block">New Post</a>
							</form>
						</li>
						<li>
							<input type="button" value="Post List" onClick="javascript:showPosts();" class="btn btn-primary btn-block" id="edit-posts">
						</li>
						<li>
							<form id="logout-form" action="dashboard.php" method="post"> 
								<button class="btn btn-primary btn-block" type="submit" name="logout">Log Out</button>
							</form>
						</li>
					</ul>
				</div>
				<!-- main content -->
				<div id="main" class="span6">
					<p>
						<?php echo "Hello, ".$_SESSION['username']."."; ?>
					</p>
					<p>
						<div id="tableSection">
							<p>Below is a list of posts by you:</p>
							<table id="postsTable" class="table table-striped">
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
						</div>
					</p>
				</div>
			</div>
		</div>
		</body>
	</html>