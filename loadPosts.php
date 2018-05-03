<?php

  $ini = parse_ini_file("config.ini");
  $limit = $_GET["limit"];
  $offset = $_GET["offset"];

  $mysql = new mysqli($ini['db_ip'], $ini['db_user'], $ini['db_password'], $ini['db_name']);

  $result_posts = $mysql->query("SELECT * FROM user_posts ORDER BY message_timestamp DESC LIMIT {$limit} OFFSET {$offset}");

  $return_arr = [];

  while($r = mysqli_fetch_assoc($result_posts)){
    array_push($return_arr,$r);
  }

  echo json_encode($return_arr);

  $mysql->close();

?>
