<?php
session_start();
include_once "../../config/connexion_7_2020.php";

$qteDes = $_POST['qteDes'];
$id = $_POST['id_game'];

if ($qteDes == 0){
    header ('Location: http://localhost/gameshark/php/client/game_client.php');

} else {

$SQL_Select = "SELECT quantity from game WHERE  id_game = '".$id."' ";
    $EXE_Select = mysqli_query($db,$SQL_Select);
    if($donnee = mysqli_fetch_assoc($EXE_Select)){

if ($qteDes > $donnee['quantity']) {
    
    echo " veuillez nous excusez mais votre reservation est impossible vous depasser le stock que nous possedons ";
    exit ();

} else {
    
   $qteTotal = $donnee['quantity'] - $qteDes;

        $SQL_update = "UPDATE game SET quantity= '".$qteTotal."' WHERE  id_game = '".$id."';";
        $EXE_update = mysqli_query($db, $SQL_update);
        
        
        $SQL_ADDreservation = "INSERT INTO `reservation`(`id_users`, `id_game`, `id_state`, `Qte`) VALUES ('".$_SESSION['id_client']."','".$id."','1','".$qteDes."');";
        $EXE_ADDreservation = mysqli_query($db, $SQL_ADDreservation);  

        header ('Location: http://localhost/gameshark/php/client/reservation_client.php');
}
    
}
else {
    printf("Error: %s\n", mysqli_error($db));
            exit();
}

}
   
?>
