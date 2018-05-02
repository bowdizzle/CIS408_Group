<?php 

	session_start();

	if ($_SESSION["username"] == null) {
		echo "Please sign in to post a message";
		exit();
	}

	if ($_POST["msg"] == null) {
		echo "Please enter a message";
		exit();
	}

	$ini = parse_ini_file("config.ini");
	
	// attempt connection to the database
	$mysqli = new mysqli($ini["db_ip"], $ini["db_user"], $ini["db_password"]);
	$mysqli->set_charset("utf8mb4");
	$mysqli->select_db($ini["db_name"]);

	
	// create table if it does not exist
	$table_create = "CREATE TABLE IF NOT EXISTS user_posts (
	id INT(10) AUTO_INCREMENT,
	username VARCHAR(36) NOT NULL,
	message_text VARCHAR(210) NOT NULL,
	message_timestamp TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (username) REFERENCES accounts (username)
	)";

	if (!$mysqli->query($table_create)) {
		echo mysqli_error($mysqli);
	}
	
	
	// insert message into database table
	$username = $_SESSION["username"];
	$message = $_POST["msg"];
	
	$stmt = $mysqli->prepare("INSERT INTO user_posts (username, message_text, message_timestamp) VALUES (?,?, CURRENT_TIMESTAMP)");
	$stmt->bind_param('ss', $username, $message);
	
	if ($stmt->execute()) {
		echo "Message posted sucessfully! <a href=\"index.php\" class=\"alert-link\">Click here to refresh the page</a>";
	} else {
		echo "There was an error posting message";
	}
	
	// clean up
	$stmt->free_result();
	$stmt->close();
	$mysqli->close();
	exit();

?>