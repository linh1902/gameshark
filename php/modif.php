<?php

include_once "../config/connexion_7_2020.php";

$donneeID=$_POST['id_game'];
$nom = $_POST['name'];
$price = $_POST['price'];
$qte = $_POST['quantity'];

if (isset($_POST['supprimer'])) {
 
    // j'ai cliqué sur supprimer
$SQL_delete = "DELETE from game where id_game = '".$donneeID."';";
$EXE_delete= mysqli_query($db, $SQL_delete);
header ('Location: http://localhost/gameshark/php/game_admin.php');

if (!$EXE_delete) {
    printf("Error: %s\n", mysqli_error($db));
    exit();


} 
 
} elseif (isset($_POST['modifier'])) {
 
   
$SQL_update = "UPDATE game SET name= '".$nom."', price= '".$price."', quantity= '".$qte."'  WHERE id_game = '".$donneeID."';";
$EXE_update= mysqli_query($db, $SQL_update);
header ('Location: http://localhost/gameshark/php/game_admin.php');


if (!$EXE_update) {
    printf("Error: %s\n", mysqli_error($db));
    exit();


}
}

?> 