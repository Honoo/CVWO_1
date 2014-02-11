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
		mysqli_close($db_found);
	}
?>