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

	<!--ANGULAR-->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js">
	</script>

	<link rel="stylesheet" href="home-style.css">

</head>
<body>

	<script type="text/javascript">
		$(function () {
			$('#register-form').submit(function (event) {

				event.preventDefault();
				let formData = $('#register-form').serialize();

				$.ajax({

					type: 'POST',
					url: 'register_action.php',
					data: formData

				}).done(response => {
					$('#message-alert').show();
					$('#message-alert').text(response);
					$("#message-alert").fadeTo(3000, 500).slideUp(500, function () {
						$("#message-alert").slideUp(500);
					});

				});
			});
		});
	</script>

	<div class='jumbotron' id='site-header'>
    	<h1 id='site-title'> <a href=index.php>NAME TBD</a></h1>
 	</div>

	<div class="container">
		
		<div id="message-alert" class="alert alert-dark alert-dismissable" role="alert" style="display: none;">
		  Message alert!
		</div>
		
		<form id="register-form" action="register_action.php" method="post" role="form">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" id="username" name="username" required>
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd" name="password" required>
			</div>
			<div class="form-group">
				<label for="pwd">Confirm Password:</label>
				<input type="password" class="form-control" id="pwd_confirm" required>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="button" class="btn btn-default" action="index.php">Cancel</button>
		</form>
	</div>

</body>
</html>