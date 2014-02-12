<?php
	// This file stores blog-related functions
	
	require_once 'includes\config.php';
	
	function createPost(){
		$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		
		$SQL = "SELECT userID FROM users WHERE username=?;";
		$stmt = mysqli_prepare($db_found,$SQL);
		mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $id);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
				
		$SQL = "INSERT INTO posts (title, content, userID) VALUES (?,?,?);";
		$stmt = mysqli_prepare($db_found,$SQL);
		mysqli_stmt_bind_param($stmt,"ssi",$_POST['title'],$_POST['editor1'],$id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($db_found);
		
		header("Location: dashboard.php");
	}
	
	function listPosts(){
		// Displays a list of posts on the dashboard written by the user
		
		$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		
		$SQL = "SELECT posts.title, posts.date_created, posts.postID FROM users, posts WHERE users.username = ? AND users.userID = posts.userID ORDER BY date_created DESC;";
		$stmt = mysqli_prepare($db_found,$SQL); 
		mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$title,$date,$id);
		while (mysqli_stmt_fetch($stmt)) {
			// Display the results in a table
			echo "<tr><td>$title</td>";
			echo "<td>$date</td>";
			echo '<td><form id="edit-form" method="get" action="post.php"><a href="post.php?type=edit&id='.$id.'" class="btn btn-primary">Edit Post</a></form></td>';
			echo '<td><form id="delete-form" method="get" action="dashboard.php"><a href="dashboard.php?id='.$id.'" class="btn btn-primary">Delete Post</a></form></td></tr>';	
		}
		mysqli_stmt_close($stmt);
		mysqli_close($db_found);
	}
	
	function displayPosts(){
		// Displays posts on the main page
		
		$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		
		$SQL = "SELECT users.username, posts.title, posts.content, posts.date_created FROM users, posts WHERE users.userID = posts.userID ORDER BY date_created DESC LIMIT 5;";
		$stmt = mysqli_prepare($db_found,$SQL);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$author,$title,$content,$date);
		while (mysqli_stmt_fetch($stmt)) {	
			// Display results
			echo "<div><h2>$title</h2></div>";
			echo "<div><h6>Posted by $author on $date</h6></div>";
			echo "<div>$content</div>";
		}
		mysqli_stmt_close($stmt);
		mysqli_close($db_found);
	}
	
	function retrievePost(){
		// Displays a post in the text editor to be edited
	
		$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		
		$SQL = "SELECT content FROM posts WHERE postID = ?;";
		$stmt = mysqli_prepare($db_found,$SQL);
		mysqli_stmt_bind_param($stmt,"i",$_GET['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$postContent);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($db_found);
		
		return $postContent;
	}
	
	function editPost(){
		// Updates an existing post
		
		$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		
		$SQL ="UPDATE posts SET content = ?, title = ? WHERE postID = ?;";
		$stmt = mysqli_prepare($db_found,$SQL);
		mysqli_stmt_bind_param($stmt,"ssi",$_POST['editor1'],$_POST['title'],$_SESSION['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($db_found);
		
		header("Location: dashboard.php");
	}
	
	function deletePost(){
		$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		$SQL = "DELETE FROM posts WHERE postID = ?;";
		$stmt = mysqli_prepare($db_found,$SQL);
		mysqli_stmt_bind_param($stmt,"i",$_GET['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($db_found);
	}
?>