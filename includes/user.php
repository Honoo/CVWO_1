<?php
	// This file stores functions related to user actions.
		
	function validateLogin($db_found){
		$uname = mysqli_real_escape_string($db_found, $_POST['username']);
		$pword = mysqli_real_escape_string($db_found, $_POST['password']);
		
		if(!$db_found){
			$errorMessage = "Can't connect to the database.";	
		}
		elseif(strlen($uname) > 20){
			$errorMessage = "Input too large. Username and password are a maximum of 20 characters each.";
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
			mysqli_stmt_close($stmt);
			$num_rows = sizeof($result);

			if($num_rows > 0){
				mysqli_close($db_found);
				
				session_start();
				$_SESSION["login"] = "1";
				$_SESSION['username'] = $uname;
				$errorMessage = '';
				header ("Location: dashboard.php");
			}
			else {
				$errorMessage = "Invalid login. Please try again.";
			}
		}
		
		return $errorMessage;
	}
	
	function signUp($db_found){
		$uname = mysqli_real_escape_string($db_found, $_POST['username']);
		$pword = mysqli_real_escape_string($db_found, $_POST['password']);
		$email = mysqli_real_escape_string($db_found, $_POST['email']);
						
		if(!$db_found){
			$errorMessage = "Can't connect to the database.";	
		}
		elseif(strlen($uname) > 20 || strlen($email) > 30){
			$errorMessage = "Input too large. Username and password are a maximum of 20 characters each while email is a maximum of 30 characters.";
		}
		else {
			// Check that the username isn't taken yet
			$SQL = "SELECT username FROM users WHERE username=?;";
			$stmt = mysqli_prepare($db_found,$SQL);
			mysqli_stmt_bind_param($stmt,"s",$uname);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $result);
			mysqli_stmt_fetch($stmt);
			mysqli_stmt_close($stmt);
			$num_rows = sizeof($result);

			if ($num_rows > 0) {
				$errorMessage = "Username already taken. Please try again.";
			}
			else {
				// Complete signup
				$SQL = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
				$stmt = mysqli_prepare($db_found,$SQL);
				mysqli_stmt_bind_param($stmt,"sss",$uname,$email,$pword);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($db_found);
				
				session_start();
				$_SESSION['username'] = $uname;
				$_SESSION['login'] = "1";
				$errorMessage = '';
				header ("Location: dashboard.php");
			}
		}
		
		return $errorMessage;
	}
	
	function logOut(){
		session_start();
		session_destroy();
		header("Location: ../index.php");
	}
?>