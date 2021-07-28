<?php
include_once "../config/connexion_7_2020.php";

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$birthdate = $_POST['birthdate'];
$mail= $_POST['mail'];
$numPhone = $_POST['numberPhone'];
$password= $_POST['password'];
$comfirmPwd= $_POST['comfirPwd'];
$role= "2";

if($password == $comfirmPwd){
    echo "mot de passe identique ";
    $SQL_SELECT = " SELECT mail FROM `users` WHERE mail ='".$mail."';";
    $exe_SQL_SELECT=  mysqli_query($db,$SQL_SELECT);
    $reponse = mysqli_fetch_assoc($exe_SQL_SELECT);

    if($mail==$reponse['mail']){
    
        echo "erreur mail deja existant";
    }
    else {
        $formatted_birthdate = date_format(new DateTime($birthdate), 'Y-m-d');
        $SQL_ADDUSER = "INSERT INTO users(user_name, surname, birth_date, mail, phone_number, password, role) VALUES ('".$nom."','".$prenom."','".$formatted_birthdate."','".$mail."','".$numPhone."','".$password."','".$role."');";
        mysqli_query($db, $SQL_ADDUSER);
        echo "bienvenue vous etre parmi nous";
    }
}


else {
    echo "erreur mot de passe non identique";
}


?>