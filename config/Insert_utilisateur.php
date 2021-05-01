<?php
/* Table d'accès utilisateur*/
/* $SQL = "INSERT INTO `Utilisateurs` (`IdUtilisateurs`, `ID`, `login`, `motdepasse`) VALUES (NULL, '2', 'toto', '1234'), (NULL, '3', 'titi', '1234');";

 */
$Nom="toto";
$Prenom="jean miche";
$Adresse="dontknow";
$Ville="mycity";
$SQL = "INSERT INTO `tableclient`(`Idclient`, `Nom`, `Prenom`, `Adresse`,'Ville) VALUES (NULL,$Nom,$Prenom,$Adresse,$Ville);";
    echo $SQL;
?>