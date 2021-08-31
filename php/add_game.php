
<?php

include_once "../config/connexion_7_2020.php";

/* récupération des donnée */

$nom = $_POST['nom'];
$img =$_POST['img'];
$platf = $_POST['plateforme'];
$release = $_POST['release'];
$price= $_POST['price'];
$state = $_POST['state'];
$qte= $_POST['qte'];

/* ajout d'un jeu sans que la date ne soit selectionnée */

if($release == ""){

        /* Ajout du jeux dans la base de donnée  */
        $SQL_ADDGAME = "INSERT INTO game(jaquette,name, id_platform, release_date, price, state, quantity) VALUES ('".$img."','".$nom."','".$platf."',NULL,'".$price."','".$state."','".$qte."');";
        $EXE_SQL_ADDGAME = mysqli_query($db, $SQL_ADDGAME);
        header ('Location: http://localhost/gameshark/php/page_accueil_admin.php');
       if (!$EXE_SQL_ADDGAME) {
        printf("Error: %s\n", mysqli_error($db));
        exit();

}
}

/* ajout d'un jeu avec date de selectionnée */

else {

        /* formatage de la date afin de l'inserer dans la base de donnée */
        $formatted_release = date_format(new DateTime($release), 'Y-m-d');

        /* Ajout du jeux dans la base de donnée  */
        $SQL_ADDGAME = "INSERT INTO game(jaquette,name, id_platform, release_date, price, state, quantity) VALUES ('".$img."','".$nom."','".$platf."','".$formatted_release."','".$price."','".$state."','".$qte."');";
        $EXE_SQL_ADDGAME = mysqli_query($db, $SQL_ADDGAME);
        header ('Location: http://localhost/gameshark/php/page_accueil_admin.php');

        if (!$EXE_SQL_ADDGAME) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
       
}
}
?>