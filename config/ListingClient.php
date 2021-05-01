<?php

//************** entete html *********
include_once "entete.php";
//***************************************

//************** Listing client *********
include_once "connexion_7_2020.php";
//***************************************

//Sur ce PHP, j'écris en mode procédural

$Table = "Clients";
//********* Requête de sélection de l'ensemble des clients`
$SQL = "SELECT * FROM ".$Table;

if ($res = mysqli_query($db,$SQL)) {

    if ($ModeDebog==1) {print "Affichage des résultats en PHP 7<br>\n";}
    //$i=0;
    //recupération du resultat
    while($enrg=mysqli_fetch_assoc($res)){
		echo "Nom/Prénom : " . $enrg['Nom'] . " " . $enrg['Prenom'] . "<br>\n";
    }

    /* Libération du jeu de résultats */
    mysqli_free_result($res);
}

echo "<p></p>\n";
echo "<a class='retour' href='index.html'>RETOUR</a>\n";
echo "</body>\n";
echo "</html>\n";

//dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd


?>