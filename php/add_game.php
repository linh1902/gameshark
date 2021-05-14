<?php
    include_once "../config/connexion_7_2020.php";


$nom = $_POST['nom'];
$img =$_POST['img'];
$platf = $_POST['plateforme'];
$release = $_POST['release'];
$price= $_POST['price'];
$state = $_POST['state'];
$qte= $_POST['qte'];

if($release == ""){


        $SQL_ADDGAME = "INSERT INTO game(jaquette,name, id_platform, release_date, price, state, quantity) VALUES ('".$img."','".$nom."','".$platf."',NULL,'".$price."','".$state."','".$qte."');";
        $EXE_SQL_ADDGAME = mysqli_query($db, $SQL_ADDGAME);
       /* header('Location: http://localhost/gameshark/php/page_accueil_admin.php');*/
       if (!$EXE_SQL_ADDGAME) {
        printf("Error: %s\n", mysqli_error($db));
        exit();

}
}

else {


        $formatted_release = date_format(new DateTime($release), 'Y-m-d');
        $SQL_ADDGAME = "INSERT INTO game(jaquette,name, id_platform, release_date, price, state, quantity) VALUES ('".$img."','".$nom."','".$platf."','".$formatted_release."','".$price."','".$state."','".$qte."');";
        $EXE_SQL_ADDGAME = mysqli_query($db, $SQL_ADDGAME);
        if (!$EXE_SQL_ADDGAME) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
      /*  header('Location: http://localhost/gameshark/php/page_accueil_admin.php');*/

}
}
?>