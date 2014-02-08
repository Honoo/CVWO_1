<?php

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
			$SQL = "SELECT * FROM users WHERE username = '$uname' AND password = '$pword';";
			$result = mysqli_query($db_found,$SQL);
			$num_rows = mysqli_num_rows($result);

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
			$SQL = "SELECT * FROM users WHERE username = '$uname';";
			$result = mysqli_query($db_found,$SQL);
			$num_rows = mysqli_num_rows($result);

			if ($num_rows > 0) {
				echo("Username already taken");
				mysqli_close($db_found);
			}
			else {
				// Complete signup
				$SQL = "INSERT INTO users (username, email, password) VALUES ('$uname', '$email', '$pword');";
				$result = mysqli_query($db_found,$SQL);

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