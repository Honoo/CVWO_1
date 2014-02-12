<?php
	require_once 'includes\user.php';
	require_once 'includes\blog.php';

	session_start();
	
	if(!(isset($_SESSION["login"]) && $_SESSION["login"] != '')){
		header("Location: login.php");
	}	
	
	if(isset($_GET['type'])){
		if($_GET['type'] == "create"){
			$_SESSION['type'] = "create";
		}
		elseif($_GET['type'] == "edit"){
			$_SESSION['type'] = "edit";
			$_SESSION['id'] = $_GET['id'];
			$postContent = retrievePost();
		}
	}
	
	if(isset($_POST['editor1'])){
		if($_SESSION['type'] == "create"){
			createPost();
		}
		else{
			editPost();
		}
		$_SESSION['type'] == "";
		$_SESSION['id'] == "";
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