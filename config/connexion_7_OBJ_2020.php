
<?php
//-------------- PHP OBJET -------------
//Composant de connexion à la base de données...


include_once "config.php";


$db = new mysqli($SERVER, $USER, $PASS, $DBASE);

if ($db->connect_errno) {//Erreur de connexion à la Bdd

if ($ModeDebog==1) {//J'affiche les erreurs
    echo "La connexion à la base de données est impossible : \n";
    echo "A. Erreur n°: " . $db->connect_errno . "\n";
    echo "B. Erreur n°: " . $db->connect_error . "\n";
}    
    // Vous voulez peut être leurs afficher quelque chose de jolie, nous ferons simplement un exit
    exit;
}
else
{
		echo "<h4>Connexion objet avec PHP Youpi !</h4>\n";


}


?>
