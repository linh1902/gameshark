<?php

include_once "../config/connexion_7_2020.php";



$mail= $_POST['mail'];
$password= $_POST['password'];
$confirmPwd= $_POST['confirmPwd'];

if (isset($_POST['valider'])) {
    if( !filter_var($mail, FILTER_VALIDATE_EMAIL) ){
    
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('votre mail n\'est pas une adresse mail comforme');
    window.location.href='http://localhost/gameshark/html/forgot_password.html';
    </script>");
    }
    else {
    /* Verification des mot de passe  */
    if($password == $confirmPwd){

    /* verification que l'adresse mail existe dans la base de donnée*/
    $newPassword = $confirmPwd;
    $SQL_SELECT = " SELECT * FROM users WHERE mail ='".$mail."';";
    $exe_SQL_SELECT=  mysqli_query($db,$SQL_SELECT);
    $reponse = mysqli_fetch_assoc($exe_SQL_SELECT);
    $role= $reponse['role'];

    if($mail==$reponse['mail']){
        if($role==1){
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('votre mail n\'est pas valide');
            window.location.href='http://localhost/gameshark/html/forgot_password.html';
            </script>");
        }
        else {
            $SQL_update= "UPDATE users SET password= '".$newPassword."' WHERE mail= '".$mail."';";
            $EXE_update= mysqli_query($db, $SQL_update);
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('mot de passe modifier');
            window.location.href='http://localhost/gameshark/html/login.html';
            </script>");
           

        }
    }else{
        echo("<script LANGUAGE='JavaScript'>
            window.alert('votre mail n\'est pas valide');
            window.location.href='http://localhost/gameshark/html/forgot_password.html';
            </script>");
    }
    }else{
        echo("<script LANGUAGE='JavaScript'>
            window.alert('mot de passe non identique');
            window.location.href='http://localhost/gameshark/html/forgot_password.html';
            </script>");
    }
}
}
    