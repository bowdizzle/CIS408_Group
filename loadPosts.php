<?php

  #echo "BEGIN";

  $ini = parse_ini_file("config.ini");

  $mysql = new mysqli($ini['db_ip'], $ini['db_user'], $ini['db_password'], $ini['db_name']);

  $result_posts = $mysql->query("Select * from posts order by post_time");

  $return_arr = [];

  while($r = mysqli_fetch_assoc($result_posts)){
    array_push($return_arr,$r);
  }

  echo json_encode($return_arr);

  $mysql->close();

  #echo "DONE!";

?>
