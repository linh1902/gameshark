<?php

// Start the session
session_start();

include_once "../config/connexion_7_2020.php";

$donneeID=$_POST['id_reservation'];
$donneeGame= $_POST['id_game'];
$qteReserver=$_POST['quantity'];
$qtedispo=$_POST['quantityAvailable'];
$qteTotal= $qtedispo - $qteReserver;
$state = $_POST['id_state'];


if (isset($_POST['ready'])) {
    
    if ($state==2) {
        
        echo "reservation deja prête veuillez patienter la recuperation";
        exit();
    }

    else {
    $SQL_ready = "UPDATE reservation INNER JOIN game on reservation.id_game = game.id_game SET id_state= 2, game.quantity= '".$qteTotal."'  WHERE id_reservation= '".$donneeID."' " ;
    $EXE_ready= mysqli_query($db, $SQL_ready);
    header ('Location: http://localhost/gameshark/php/reservation_admin.php');
}

    }
elseif  (isset($_POST['paid'])) {
    if ($state==1) {
        
        echo "Veuillez deja preparer la demande et cliquer sur pret avant ";
        exit();
    }
    else {
        $SQL_paid = "UPDATE reservation SET id_state= 3  WHERE id_reservation= '".$donneeID."' " ;
        $EXE_paid= mysqli_query($db, $SQL_paid);

        header ('Location: http://localhost/gameshark/php/reservation_admin.php');
    }

}

    