<?php

// initialize the ini file 
$ini = parse_ini_file("config.ini");

// set up connection and statement to prevent sql injection
$mysqli = new mysqli($ini["db_ip"], $ini["db_user"], $ini["db_password"]);
$mysqli->set_charset("utf8mb4");

if (mysqli_connect_errno()) {
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


// perform the statement and output result
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