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

  let offset = 10;
  let morePosts =  true;

  function showSubmitForm() {
    document.getElementById("submit-post-btn").style.display = "none";
    document.getElementById("submit-form").style.display = "block";
  }

  // Function to call post loading
  function loadPosts(limit, offset) {
    $.ajax({

      type: "GET",
      url: "./loadPosts.php",
      data: {
        limit: limit,
        offset: offset
      }

    }).done(function(data) {

      let post_list = JSON.parse(data);
      let post_no = 0;

      while (post_no < post_list.length) {

        let post = post_list[post_no]
        let newPost = document.createElement("div");
        newPost.className = "user-post";

        let m = document.createElement("p");
        m.className = "post-msg";
        m.innerHTML = post.message_text;

        let tag = document.createElement("p");
        tag.className = "post-tag";
        tag.innerHTML = "<b>" + post.username + "</b> <br> " + post.message_timestamp;

        let breakline = document.createElement("hr");

        newPost.append(m);
        newPost.append(breakline);
        newPost.append(tag);
        document.getElementById("feed-block").append(newPost);

        post_no++;

      }

      if (post_list.length < limit) {
        morePosts = false;
      }

    }).fail(function(){
      console.log("FAILED TO LOAD POSTS from loadPosts.php");
    });
  }

  // When page loads, load posts
  $(document).ready(function() {
    loadPosts(10, 0);
  });

  // Check when user has scrolled to the bottom of the page
  $(window).scroll(function() {
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
      if (morePosts) {
        loadPosts(10, offset);
        offset = offset + 10;
      }
    }
  });

  // Saves a post to the database based on what is in the text area
  $(function() {
    $('#submit-form').submit(function(event) {
      event.preventDefault();
      let formData = $('#submit-form').serialize();
      $.ajax({
        type: 'POST',
        url: 'submit_post.php',
        data: formData
      }).done(response => {

        $('#message-content').val('');
        $('#message-alert').show();
        $('#message-alert').html(response);
        $("#message-alert").fadeTo(5000, 500).slideUp(500, function(){
            $("#message-alert").slideUp(500);
        });
      });
      // location.reload();
    });
  });
</script>

<body>


  <div class='jumbotron position-sticky fixed-top' id='site-header'>
      <h1 id='site-title'> <a href=#>Vikespace </a></h1>
    </div>
  <div ng-app="" class = "container-fluid">



    <div id="message-alert" class="alert alert-dark alert-dismissable" role="alert" style="display: none;">
      Message alert!
    </div>


    <div class = "row">

      <div class = "col-sm-0 col-md-3" id="left-margin">

        <?php

        if ($_SESSION["username"] != null) {
          echo '<button id="user-display" class="btn">Signed in as ' . $_SESSION["username"] . '</button>';
          echo '<button id="sign-out-btn" class="btn" onclick="location.href=\'signout.php\';">Sign out</button>';
        } else {
          echo '<button id="sign-in-btn" class="btn" onclick="location.href=\'login.php\';">Sign in</button>';
          echo '<button id="register-btn" class="btn" onclick="location.href=\'register.php\';">Sign Up</button>';
        }

        ?>

        <hr>

        <button class="btn" id="submit-post-btn" onclick="showSubmitForm()">Compose Message</button>
        <form id="submit-form" action="submit_post.php" method="post">
          <p><b>Message:</b></p>
          <div class="container-fluid">
            <textarea id="message-content" class="form-control" name="msg" rows="5" cols="40" maxlength="200" ng-model="sub_msg"></textarea>
            <br>
            <p>{{(sub_msg.length+0)+"/200"}}
          </div>
          <button class="btn btn-secondary" type="submit"> Submit Post </button>
        </form>

        <hr>

      </div>


      <div id = "feed-block" class = "col-sm-12 col-md-6">

      </div>


      <div class = "col-sm-0 col-md-3" id="right-margin">
        <img src="viking.gif" alt="CSU Vikes Logo" class="rounded mx-auto d-block" style="opacity: .25">
      </div>
    </div>
  </div>

</body>
</html>
