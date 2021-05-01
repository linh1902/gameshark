<?php
    include_once "../config/connexion_7_2020.php";


$nom = $_POST['nom'];
$platf = $_POST['plateforme'];
$release = $_POST['release'];
$price= $_POST['price'];
$state = $_POST['state'];
$qte= $_POST['qte'];

if($release == ""){


        $SQL_ADDGAME = "INSERT INTO game(name, id_platform, release_date, price, state, quantity) VALUES ('".$nom."','".$platf."',NULL,'".$price."','".$state."','".$qte."');";
        mysqli_query($db, $SQL_ADDGAME);
        echo "Votre jeux a ete rajouté sans date";

}

else {


        $formatted_release = date_format(new DateTime($release), 'Y-m-d');
        $SQL_ADDGAME = "INSERT INTO game(name, id_platform, release_date, price, state, quantity) VALUES ('".$nom."','".$platf."','".$formatted_release."','".$price."','".$state."','".$qte."');";
        mysqli_query($db, $SQL_ADDGAME);
        echo "Votre jeux a ete rajouté avec date";


}

?>