<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Register</title>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="home-style.css">
</head>
<body>

	<div class='jumbotron' id='site-header'>
    	<h1 id='site-title'> <a href=index.html>NAME TBD </a></h1>
	</div>
	
	<div class="container">
		
		<?php

		$ini = parse_ini_file("config.ini");

		// set up connection and statement to prevent sql injection
		$mysqli = new mysqli($ini["db_ip"], $ini["db_user"], $ini["db_password"]);
		$mysqli->set_charset("utf8mb4");

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}

		// query strings
		$db_create = "CREATE DATABASE IF NOT EXISTS " . $ini["db_name"];
		$table_create = "CREATE TABLE IF NOT EXISTS accounts (
							id INT(10) AUTO_INCREMENT,
							username VARCHAR(36) NOT NULL,
							password VARCHAR(255) NOT NULL,
							PRIMARY KEY (id),
							UNIQUE (username)
						)";

		// creates database if it doesnt exist
		$mysqli->query($db_create);
		$mysqli->select_db($ini["db_name"]);

		// creates table if it doesnt exist
		$mysqli->query($table_create);

		// prepare insert statement to add account
		$username = $_POST["username"];
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

		$stmt = $mysqli->prepare("INSERT INTO accounts (username, password) VALUES (?,?)");
		$stmt->bind_param('ss', $username, $password);
		
		if ($stmt->execute()) {
			echo "You have succesfully registered as " . $username . "!";
		} else {
			echo "Username has been taken, please try another username.";
		}

		// clean up
		$stmt->free_result();
		$stmt->close();
		$mysqli->close();
		
		 ?>

	</div>
	
	<php>

</body>
</html>