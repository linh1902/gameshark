<?php 
session_start();
/* deconnexion de la session*/
session_destroy();
header('Location: http://localhost/gameshark/html/login.html');
?>
