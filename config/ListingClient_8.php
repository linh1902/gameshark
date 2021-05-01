<?php

//************** entete html *********
include_once "entete.php";
//***************************************

//************** Connexion *********
include_once "connexion_7_OBJ_2020.php";
//***************************************

//****** Sur ce PHP j'écris en mode OBJET

$Table = "Clients";
//********* Requête de sélection de l'ensemble des clients`
$SQL = "SELECT * FROM ".$Table;


if (!$res = $db->query($SQL)) {
    // Oh non ! La requête a échoué. 
    echo "Désolé, le site web subit des problèmes.";


//***************** ERREUR DE REQUETE ********************
if ($ModeDebog==1) {//J'affiche les erreurs
    echo "Problème sur le site lors de la recherche d'un client :\n";
    echo "Requête : " . $SQL . "\n";
    echo "A. Erreur n°: " . $db->errno . "\n";
    echo "B. Erreur n°: " . $db->error . "\n";
}

exit;
//*********************************************************


}




//pppppppppppppp DONNEES OK    DONNEES OK    pppppppppppp
if ($res->num_rows === 0) {
    //La table est vide... donc pas de jeu de données...
    echo "Il n'y a aucun jeu de données dans la table ou le client n'existe pas...";
    exit;
}
//pppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppp

//dddddddddddddddd AFFICHAGE DES DONNEES ddddddddddddddddddddddd

//*$enrg = $res->fetch_assoc();
//recupération des resultats
while($enrg = $res->fetch_assoc()){
echo "Nom/Prénom : " . $enrg['Nom'] . " " . $enrg['Prenom'] . "<br>\n";
}

$res->free();

echo "<p></p>\n";
echo "<a class='retour' href='index.html'>RETOUR</a>\n";
echo "</body>\n";
echo "</html>\n";
//dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd


?>