<?php
	// This file stores functions related to user actions.

	require_once 'includes\config.php';
	
	function validateLogin(){
		// Connect to the database
		$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		
		$uname = mysqli_real_escape_string($db_found, $_POST['username']);
		$pwordraw = mysqli_real_escape_string($db_found, $_POST['password']);
		$pword = md5($uname.$pwordraw);
		
		if(!$db_found){
			echo("Can't connect to the database");	
			mysqli_close($db_found);
		}
		elseif(strlen($uname) > 20 || strlen($pwordraw) > 20){
			echo("Input too large. Username and password are a maximum of 20 characters each.");
			mysqli_close($db_found);
		}
		else {
			// Check if the login details are correct
			
			// Prepare and execute the SQL query
			$SQL = "SELECT username FROM users WHERE username=? AND password=?;";
			$stmt = mysqli_prepare($db_found,$SQL);
			mysqli_stmt_bind_param($stmt,"ss",$uname,$pword);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $result);
			mysqli_stmt_fetch($stmt);
			$num_rows = sizeof($result);

			if($num_rows > 0){
				mysqli_close($db_found);
				
				session_start();
				$_SESSION["login"] = "1";
				header ("Location: dashboard.php");
			}
			else {
				echo("Invalid login. Please try again.");
				mysqli_close($db_found);
			}
		}
	}
	
	function signUp(){
		// Connect to the database
		$db_found = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		
		$uname = mysqli_real_escape_string($db_found, $_POST['username']);
		$pwordraw = mysqli_real_escape_string($db_found, $_POST['password']);
		$pword = md5($uname.$pwordraw);
		$email = mysqli_real_escape_string($db_found, $_POST['email']);
						
		if(!$db_found){
			echo("Can't connect to the database");	
			mysqli_close($db_found);
		}
		elseif(strlen($uname) > 20 || strlen($pwordraw) > 20 || strlen($email) > 30){
			echo("Input too large. Username and password are a maximum of 20 characters each while email is a maximum of 30 characters.");
			mysqli_close($db_found);
		}
		else {
			// Check that the username isn't taken yet
			$SQL = "SELECT username FROM users WHERE username=?;";
			$stmt = mysqli_prepare($db_found,$SQL);
			mysqli_stmt_bind_param($stmt,"s",$uname);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $result);
			mysqli_stmt_fetch($stmt);
			$num_rows = sizeof($result);

			if ($num_rows > 0) {
				echo("Username already taken");
				mysqli_close($db_found);
			}
			else {
				// Complete signup
				$SQL = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
				$stmt = mysqli_prepare($db_found,$SQL);
				mysqli_stmt_bind_param($stmt,"sss",$uname,$email,$pword);
				mysqli_stmt_execute($stmt);

				mysqli_close($db_found);
				
				session_start();
				$_SESSION['login'] = "1";
				header ("Location: dashboard.php");
			}
		}
	}
	
	function logOut(){
		session_start();
		session_destroy();
		header("Location: index.php");
	}
?>