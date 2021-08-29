<?php
session_start();
include_once "../config/connexion_7_2020.php";
if(isset($_POST['mail']) && isset($_POST['password'])){
 
$mail= $_POST['mail'];
$password= $_POST['password'];
$role= "";


    if($mail !== "" && $password !== "")
    {

    $SQL_SELECT_ROLE = " SELECT id_users, role, user_name, surname FROM `users` WHERE mail ='".$mail."' AND password = '".$password."';";
     $exe_SQL_SELECT_ROLE=  mysqli_query($db,$SQL_SELECT_ROLE);
     $reponse = mysqli_fetch_array($exe_SQL_SELECT_ROLE);
     //$reponse.length;
     $role= $reponse['role'];
         if($role==1){ 
            
            // Storing session data
            $_SESSION["firstname"] = $reponse['surname'];
            $_SESSION["lastname"] = $reponse['user_name'];
             header('location: http://localhost/gameshark/php/page_accueil_admin.php');
      
        }
        if($role==2){
             // Storing session data
             $_SESSION["firstname"] = $reponse['surname'];
             $_SESSION["lastname"] = $reponse['user_name'];
             $_SESSION["id_client"] = $reponse ['id_users'];
            header('location: http://localhost/gameshark/php/client/page_accueil_client.php');
        
        }
        

        else
    {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Erreur mail out mot de passe invalide');
        window.location.href='http://localhost/gameshark/html/login.html';
     </script>");
    }
}
}




?>