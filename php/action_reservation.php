<?php

// Start la session
session_start();


include_once "../config/connexion_7_2020.php";

/* récupération des donnée */

$donneeID=$_POST['id_reservation'];
$donneeGame= $_POST['id_game'];
$qteReserver=$_POST['quantity'];
$qtedispo=$_POST['quantityAvailable'];
$qteTotal= $qtedispo - $qteReserver;
$state = $_POST['id_state'];


if (isset($_POST['ready'])) {
    /* Cas ou le jeux est deja pret */ 
    if($state==2) {
        
        echo ("<script LANGUAGE='JavaScript'>
          window.alert('Jeux deja pret veuillez patienter le paiement');
          window.location.href='http://localhost/gameshark/php/reservation_admin.php';
       </script>");
        exit();
    }
    /*  Cas ou la reservation a été annuler au prealable par le client  */
    elseif($state==3) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Commande annulée veuillez appuyer sur paid pour le retirer');
        window.location.href='http://localhost/gameshark/php/reservation_admin.php';
     </script>");
        exit();
    }
     /*  Cas ou la  reservation est en état de demande reservation  par le client  l'administrateur permet de changer  l'etat du jeux en etant prêt  */
    elseif($state==1){
    $SQL_ready = "UPDATE reservation INNER JOIN game on reservation.id_game = game.id_game SET id_state= 2 WHERE id_reservation='".$donneeID."'" ;
    $EXE_ready= mysqli_query($db,$SQL_ready);
     header ('Location: http://localhost/gameshark/php/reservation_admin.php');
}

    }
    /*  permet de mettre une reservation en état de "payer / annuler "  */
elseif  (isset($_POST['paid'])) {
    if ($state==1) {
        
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Veuillez deja préparer la commande avant de la valider ');
        window.location.href='http://localhost/gameshark/php/reservation_admin.php';
     </script>");
        exit();
    }
    else {
        $SQL_paid = "UPDATE reservation SET id_state= 4  WHERE id_reservation= '".$donneeID."' " ;
        $EXE_paid= mysqli_query($db, $SQL_paid);

        header ('Location: http://localhost/gameshark/php/reservation_admin.php');
    }

}

    