<?php
  function callac($servername, $username, $password, $dbnameac){
    $connac = mysqli_connect($servername, $username, $password, $dbnameac);
    if (!$connac) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else {
      return $connac;
    }
  }

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  ?>