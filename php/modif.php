<?php

include_once "../config/connexion_7_2020.php";

$donneeID=$_POST['id_game'];
$nom = $_POST['name'];
$price = $_POST['price'];
$qte = $_POST['quantity'];


$SQL_update = "UPDATE game SET name= '".$nom."', price= '".$price."', quantity= '".$qte."'  WHERE id_game = '".$donneeID."';";
$EXE_update= mysqli_query($db, $SQL_update);
echo "jeux modifier";

if (!$EXE_update) {
    printf("Error: %s\n", mysqli_error($db));
    exit();


}

?> 