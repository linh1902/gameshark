<?php
include_once "../config/connexion_7_2020.php";

/* récupération des donnée */

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$birthdate = $_POST['birthdate'];
$mail= $_POST['mail'];
$numPhone = $_POST['numberPhone'];
$password= $_POST['password'];
$comfirmPwd= $_POST['comfirPwd'];
$role= "2";

 /* securisation d'une adresse mail comforme */

if( !filter_var($mail, FILTER_VALIDATE_EMAIL) ){

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('votre mail n\'est pas une adresse mail conforme');
    window.location.href='http://localhost/gameshark/html/inscription.html';
 </script>");
  exit();
}
else {
    /* Verification des mot de passe  */
if($password == $comfirmPwd){

    /* verification que l'adresse mail n'existe pas deja dans notre base de donnée */

    $SQL_SELECT = " SELECT mail FROM `users` WHERE mail ='".$mail."';";
    $exe_SQL_SELECT=  mysqli_query($db,$SQL_SELECT);
    $reponse = mysqli_fetch_assoc($exe_SQL_SELECT);

   /* Si mail deja existant renvoi une alerte */
    if($mail==$reponse['mail']){
    
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('votre mail existe déjà ');
        window.location.href='http://localhost/gameshark/html/login.html';
     </script>");
    }
    /* si mail non existant formatage de la date de naissance et ajout  dans la base de donnée */
    else {
        $formatted_birthdate = date_format(new DateTime($birthdate), 'Y-m-d');
        $SQL_ADDUSER = "INSERT INTO users(user_name, surname, birth_date, mail, phone_number, password, role) VALUES ('".$nom."','".$prenom."','".$formatted_birthdate."','".$mail."','".$numPhone."','".$password."','".$role."');";
        mysqli_query($db, $SQL_ADDUSER);
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Bienvenue votre compte a été créé');
        window.location.href='http://localhost/gameshark/html/login.html';
     </script>");
    }
}

 /* si mot de passe non identique*/
else {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('mot de passe non identique veuillez les ressaisirs');
    window.location.href='http://localhost/gameshark/html/inscription.html';
 </script>");
}
}

?>