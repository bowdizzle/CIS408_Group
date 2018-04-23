<?php session_start(); ?>
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

	<link rel="stylesheet" href="home-style.css">
</head>
<body>

  <div class='jumbotron' id='site-header'>
    <h1 id='site-title'> <a href=index.html>NAME TBD </a></h1>
  </div>

	<div class="container">

		<div>
			<?php 

			if ($_SESSION["username"] != null) {
				echo "Currently signed in as {$_SESSION["username"]}";
			} else {
				echo "Not signed in";
			}

			?>
		</div>
		
		<form action="login.php" method="post" role="form">
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

			<?php

			$ini = parse_ini_file("config.ini");

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
				// gets info user submitted
				$username = $_POST["username"];
				$password = $_POST["password"];
			
				$mysqli = new mysqli($ini["db_ip"], $ini["db_user"], $ini["db_password"]);
				$mysqli->set_charset("utf8mb4");
				$mysqli->select_db($ini["db_name"]);
			
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
					$_SESSION['username'] = $username;
				} else {
					echo "Incorrect log in";
				}

				// clean up
				$stmt->free_result();
				$stmt->close();
				$mysqli->close();
			}

 			?>
	</div>

</body>
</html>