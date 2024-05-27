<?php
session_start();
if (isset($_SESSION['token']))
{
  require_once './composent/hidden/config.php';
  require_once "./composent/database/connect.php";
  list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$_SESSION['token']);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>0Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/header.css">
    <link rel="stylesheet" href="assets/formsignin.css">
    <link rel="stylesheet" href="assets/footer.css">
    <link rel="stylesheet" href="assets/primary.css">
  </head>
  <body>
      <?php
        if (isset($_SESSION['error'])){require_once "./composent/template/ealerts.php";}
        if (isset($_SESSION['success'])){require_once "./composent/template/salerts.php";}
        require_once "./composent/template/header.php";
      ?>
      <main>
      <?php
        require_once "./composent/main/main.php";
        require_once "./composent/main/signinform.php";
        require_once "./composent/main/loginclient.php";
        require_once "./composent/main/loginbanker.php";
        require_once "./composent/template/footer.php";
      ?>
      </main>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
      <script src="./script.js"></script>
  </body>
</html>
