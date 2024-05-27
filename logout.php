<?php
session_start();
$error = $_SESSION['error'];
session_destroy();
session_start();
if (isset($error)){$_SESSION['error'] = $error;}
else {$_SESSION['success'] = "Vous avez était déconnecté avec succès";}
header("Location:index.php");
?>