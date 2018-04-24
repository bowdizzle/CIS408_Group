<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

  <title>Homepage</title>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
  
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
  
  <!-- Customized Style -->
  <link rel = 'stylesheet' href = 'home-style.css'>

</head>

<script type="text/javascript">
  function showSubmitForm(){
    document.getElementById("submit-post-btn").style.display="none";
    document.getElementById("submit-form").style.display = "block";
  }
</script>

<body>
<div class = "container-fluid">

  <div class='jumbotron' id='site-header'>
    <h1 id='site-title'> <a href=#>NAME TBD </a></h1>
  </div>

  <div class = "row">

    <div class = "col-sm-0 col-md-3" id="left-margin">

      <button id="submit-post-btn" onclick="showSubmitForm()">SUBMIT NEW POST</button>

      <form id="submit-form" action="submit_post.php" method="post">
        <p><b>Message:</b></p>
        <textarea name="msg" rows="5" cols="40" maxlength="200"></textarea>
        <br>
        <button type="submit"> Submit Post </button>
        <hr>
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
