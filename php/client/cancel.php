<?php
session_start();
include_once "../../config/connexion_7_2020.php";

$donneeID=$_POST['id_reservation'];
$id = $_POST['id_game'];


// Selection de la quantite de jeux reserver dans la base de donnee en fonction de l'id du client
$SQL_Select_Qte = "SELECT Qte from reservation WHERE  id_users = '".$_SESSION["id_client"]."' AND id_game = '".$id."'  ";
    $EXE_Select_Qte = mysqli_query($db,$SQL_Select_Qte);
    if($donnee_Qte = mysqli_fetch_assoc($EXE_Select_Qte)){


// selection de la  quantite disponible du jeu au moment de la requete 
$SQL_Select = "SELECT quantity from game WHERE  id_game = '".$id."' ";
    $EXE_Select = mysqli_query($db,$SQL_Select);
    if($donnee = mysqli_fetch_assoc($EXE_Select)){

    // Update de  la quantité dans la base pour le jeux dont l'id correspond
        $qteTotal = $donnee_Qte['Qte'] + $donnee['quantity'];

        $SQL_update = "UPDATE game SET quantity= '".$qteTotal."' WHERE  id_game = '".$id."';";
        $EXE_update = mysqli_query($db, $SQL_update);

    // Annulation via l'update de reservation
        $SQL_cancel = "UPDATE reservation  SET id_state= 3   WHERE id_reservation = '".$donneeID."' " ;
        $EXE_cancel= mysqli_query($db, $SQL_cancel);
        if (!$EXE_cancel) {
         printf("Error: %s\n", mysqli_error($db));
            exit();
            } else {
            header ('Location: http://localhost/gameshark/php/client/reservation_client.php');
          }
    }
    // affichage en cas d'erreur de la requete $SQL_SELECT
    else {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
}
// affichage en cas d'erreur de la requete $SQL_SELECT_QTE
else{
    printf("Error: %s\n", mysqli_error($db));
    exit();
}


?>