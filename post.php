<?php
	session_start();
	
	if(!(isset($_SESSION["login"]) && $_SESSION["login"] != '')){
		header("Location: login.php");
	}	
	
	require_once 'includes\blog.php';
	require_once 'includes\config.php';
	
	$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$postContent = '';
	
	if(isset($_GET['type'])){
		if($_GET['type'] == "create"){
			$_SESSION['type'] = "create";
		}
		elseif($_GET['type'] == "edit"){
			$_SESSION['type'] = "edit";
			$_SESSION['id'] = $_GET['id'];
			$postContent = retrievePost($db_found);
		}
	}
	
	if(isset($_POST['editor1'])){
		if($_SESSION['type'] == "create"){
			createPost($db_found);
		}
		else{
			editPost($db_found);
		}
		$_SESSION['type'] == "";
		$_SESSION['id'] == "";
	}
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<?php
				include "common\header.php";
			?>
			<script type="text/javascript" src="static/ckeditor/ckeditor.js"></script>
			<title>Post Editor</title>
		</head>
		<body>
			<div class="container-fluid">
				<div class="navbar">
					<div class="tabbable">
					  <ul class="nav nav-tabs">
						<li><a href="index.php">Home</a></li>
						<li><a href="dashboard.php">Dashboard</a></li>
					  </ul>
					</div> 
				</div>
				<!-- text editor -->
				<form id="post-form" method="post" action="post.php">
					<p>
						<input type="text" name="title" value="Title" maxlength="50"/>
					</p>
					<p>
						<textarea id="editor1" name="editor1">&lt;p&gt;
						<?php echo $postContent; ?>
						&lt;/p&gt;</textarea>
						<script type="text/javascript">
							CKEDITOR.replace( 'editor1' );
						</script>
					</p>
					<p>
						<input type="submit" />
					</p>
				</form>
			</div>
		</body>
	</html>