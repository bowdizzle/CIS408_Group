
<html>
<body>
<?php

  $mysql = mysqli_connect("localhost", "test", "password", "user_posts");

  if($mysql->connect_error){echo "ERROR";}

  $message = $_POST["msg"];

  $user = "user";
  $timestamp = date("Y-m-d H:i:s", time());

  $sql = "INSERT INTO posts values('$user', '$timestamp', '$message')";

  $mysql->close();

  header("Location:index.html");

  exit();

?>
</body>
</html>
