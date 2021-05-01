<?php

if(isset($_POST['mail']) && isset($_POST['password'])){
 
include_once "../config/connexion_7_2020.php";

$mail= $_POST['mail'];
$password= $_POST['password'];
$role= "";
/*
$SQL_SELECT_COUNT = "SELECT count (*) FROM 'users' WHERE mail ='".$mail."'and password = '".$password."';";
$exe_SQL_SELECT_COUNT=  mysqli_query($db,$SQL_SELECT_COUNT);
$reponse = mysqli_fetch_array($exe_SQL_SELECT_COUNT);
 $count = $reponse['count(*)'];
 
 if($count>0) // nom d'utilisateur et mot de passe correctes
 {  */
    if($mail !== "" && $password !== "")
    {

    $SQL_SELECT_ROLE = " SELECT role FROM `users` WHERE mail ='".$mail."' AND password = '".$password."';";
     $exe_SQL_SELECT_ROLE=  mysqli_query($db,$SQL_SELECT_ROLE);
     $reponse = mysqli_fetch_array($exe_SQL_SELECT_ROLE);
     //$reponse.length;
     $role= $reponse['role'];
         if($role==1){ 

            echo $role;
             header('location: http://localhost/gameshark/html/page_accueil_admin.php');
      
        }
        if($role==2){

            echo $role;
            header('location: http://localhost/gameshark/php/page_client.php');
        
        }
        

        else
    {
  echo "erreur";
    }
}

else
{
echo "mot de passe ou mail vide";
}
}
else
{
header('location: http://localhost/gameshark/html/login.php');
}



?>