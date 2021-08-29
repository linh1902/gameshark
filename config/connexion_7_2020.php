
<?php
//-------------- PHP PROCEDURAL -------------
//Composant de connexion à la base de données...

include_once "config.php";


$db = mysqli_connect($SERVER, $USER, $PASS, $DBASE);
/*
if (!$db && $ModeDebog==1) {//J'affiche les erreurs
    echo "La connexion à la base de données est impossible." . PHP_EOL;
    echo "A. Erreur n°: " . mysqli_connect_errno() . PHP_EOL;
    echo "B. Erreur n°: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if ($ModeDebog==1) {
echo "Connexion à la Base de données réussie.".PHP_EOL;
echo "Information de connexion : " . mysqli_get_host_info($db) . PHP_EOL;
}

*/
//*********** Clôture de la connexion
//mysqli_close($db);


?>
