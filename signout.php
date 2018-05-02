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

	<title>Sign Out</title>
	<link rel="stylesheet" href="home-style.css">

</head>
<body>

	<div class='jumbotron' id='site-header'>
	  <h1 id='site-title'> <a href=index.php>Vikespace </a></h1>
	</div>

	<div class="container">
		<?php

		if ($_SESSION["username"] != null) {
			session_destroy();
			echo "You have succesfully signed out!";
			//Redirect to homepage after signout
			//header('Location: index.php');
		} else {
			echo "Not signed in";
		}
		echo " <a href=index.php>Click here to return to the home page</a>";
		?>
	</div>

</body>
</html>
