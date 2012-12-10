<?php

  function db_connect() {
    $mysqli = new mysqli('localhost', 'root', 'password', 'gaar');

    if($mysqli->connect_errno)
      echo 'Failed to connect to MySql: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
    else
      return $mysqli;
  }

  function query_errors($conn) {
    echo 'Query error: (' . $conn->errno . ') ' . $conn->error;
  }

?>
