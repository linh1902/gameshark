<?php 
session_start();

session_destroy();
header('Location: http://localhost/gameshark/html/login.html');
?>
