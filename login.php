<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>CSU OpenBoard - Login</title>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

	<div class="container">
		<form action="/final/login.php" method="post" role="form">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" id="username" name="username" required>
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd" name="password" required>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>

	<?php 

	// gets info user submitted
	$username = $_POST["username"];
	$password = $_POST["password"];

	$mysqli = new mysqli("127.0.0.1", "DB_USER", "DB_PASSWORD");
	$mysqli->set_charset("utf8mb4");
	$mysqli->select_db("finalProject");

	// prepare statement to grab hashed password for given user
	$stmt = $mysqli->prepare("SELECT password FROM accounts WHERE username = ?");
	$stmt->bind_param('s', $username);
	$stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
	$result = $stmt->get_result();

	// fetch results and put them into an array
	$data = array();

	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
	
	// TODO: this is temporary to see if password checking works
	// check password against stored password
	$stored_password = $data[0]["password"];
	if (password_verify($password, $stored_password)) {
		echo "Succesfully logged in!";
	} else {
		echo "Incorrect log in";
	}

	// clean up
	$stmt->free_result();
	$stmt->close();
	$mysqli->close();

	 ?>

</body>
</html>