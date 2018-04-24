<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Homepage</title>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <!--ANGULAR-->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js">
  </script>

  <link rel="stylesheet" href="home-style.css">

</head>

<script type="text/javascript">
  function showSubmitForm(){
    document.getElementById("submit-post-btn").style.display="none";
    document.getElementById("submit-form").style.display = "block";
  }
</script>

<body>
<div ng-app="" class = "container-fluid">

  <div class='jumbotron' id='site-header'>
    <h1 id='site-title'> <a href=#>NAME TBD </a></h1>
  </div>

  <div class = "row">

    <div class = "col-sm-0 col-md-3" id="left-margin">

      <button class="btn" id="submit-post-btn" onclick="showSubmitForm()">SUBMIT NEW POST</button>

      <form id="submit-form" action="submit_post.php" method="post">
        <p><b>Message:</b></p>
        <div class="container-fluid">
          <textarea class="form-control" name="msg" rows="5" cols="40"
            maxlength="200" ng-model="sub_msg"></textarea>
            <p>{{(sub_msg.length+0)+"/200"}}
        </div>

        <br>
        <hr>
        <button class="btn btn-primary" type="submit"> Submit Post </button>
      </form>

    </div>

    <div id = "feed-block" class = "col-sm-12 col-md-6">

      <div class="user-post" id="example-post">

          <p class = "post-msg">This is an example of a post that a user can make.
            </p>
          <hr>
          <p class = "post-tag"><b>USERNAME</b> | 11:06 pm, Jan 5, 2009</p>

      </div>

      <div class="user-post" id="example-post">

          <p class = "post-msg">This is an example of a post that a user can make.
            </p>
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
