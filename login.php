<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- Optional JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- Font and Style -->
	<link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">

	<title>Login</title>
	<link rel="stylesheet" href="home-style.css">
</head>
<body>

  <div class='jumbotron' id='site-header'>
    <h1 id='site-title'> <a href=index.php>Vikespace </a></h1>
  </div>

	<div class="container">

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
					echo "<br>Succesfully logged in! <a href=index.php>Click here to return to the home page</a>";
					$_SESSION['username'] = $username;
					//Redirect to homepage after successful Login
					// header('Location: index.php');
				} else {
					echo "<br>Incorrect log in";
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
