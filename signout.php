<?php

session_start();

unset($_SESSION['ValidUser']);
// send 'em back to the login form
header('Location: login.php');
die();

?>