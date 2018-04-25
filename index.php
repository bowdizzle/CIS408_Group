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

  <!--ANGULAR-->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js">
  </script>

  <link rel="stylesheet" href="home-style.css">
  <title>Homepage</title>

</head>

<script type="text/javascript">

  function showSubmitForm() {
    document.getElementById("submit-post-btn").style.display = "none";
    document.getElementById("submit-form").style.display = "block";
  }

  $(function() {
    $('#submit-form').submit(function(event) {

      event.preventDefault();
      let formData = $('#submit-form').serialize();

      $.ajax({

        type: 'POST',
        url: 'submit_post.php',
        data: formData

      }).done(response => {

        $('#message-alert').show();
        $('#message-alert').text(response);
        $("#message-alert").fadeTo(3000, 500).slideUp(500, function(){
            $("#message-alert").slideUp(500);
        });

      });
    });
  });

</script>

<body>

  <div ng-app="" class = "container-fluid">
  
    <div class='jumbotron' id='site-header'>
      <h1 id='site-title'> <a href=#>NAME TBD </a></h1>
    </div>
  
  
    <div id="message-alert" class="alert alert-dark alert-dismissable" role="alert" style="display: none;">
      Message alert!
    </div>
  
  
    <div class = "row">
  
      <div class = "col-sm-0 col-md-3" id="left-margin">
        <button class="btn" id="submit-post-btn" onclick="showSubmitForm()">Compose Message</button>
        <form id="submit-form" action="submit_post.php" method="post">
          <p><b>Message:</b></p>
          <div class="container-fluid">
            <textarea class="form-control" name="msg" rows="5" cols="40" maxlength="200" ng-model="sub_msg"></textarea>
            <br>
            <p>{{(sub_msg.length+0)+"/200"}}
          </div>
          <button class="btn btn-primary" type="submit"> Submit Post </button>
        </form>
      </div>
  
  
      <div id = "feed-block" class = "col-sm-12 col-md-6">
  
        <div class="user-post" id="example-post">
            <p class = "post-msg">This is an example of a post that a user can make.</p>
            <hr>
            <p class = "post-tag"><b>USERNAME</b> | 11:06 pm, Jan 5, 2009</p>
        </div>
  
  
        <div class="user-post" id="example-post">
            <p class = "post-msg">This is an example of a post that a user can make.</p>
            <hr>
            <p class = "post-tag"><b>USERNAME</b> | 11:06 pm, Jan 5, 2009</p>
        </div>
        
      </div>
  
  
      <div class = "col-sm-0 col-md-3" id="right-margin">

        <?php 
  
        if ($_SESSION["username"] != null) {
          echo '<button id="user-display" class="btn">Signed in as ' . $_SESSION["username"] . '</button>';
          echo '<button id="sign-out-btn" class="btn" onclick="location.href=\'signout.php\';">Sign out</button>';
        } else {
          echo '<button id="sign-in-btn" class="btn" onclick="location.href=\'login.php\';">Sign in</button>';
          echo '<button id="register-btn" class="btn" onclick="location.href=\'register.php\';">Sign Up</button>'; 
        }
  
        ?>

      </div>
    </div>
  </div>

</body>
</html>
