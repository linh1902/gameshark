<?php 
session_start();
 
if(!$_SESSION) {
    // Si la session n'est pas ouverte ...
    echo "probleme de session veuillez vous reconnecter";
    
    }
else {
 $firstname = $_SESSION["firstname"];
 $lastname = $_SESSION["lastname"]

?>


<!DOCTYPE html>
<html>
<?php 
    include_once "../html/header.html";
    include_once  "../config/connexion_7_2020.php";
?>

<head>
 <link rel="stylesheet" href="../css/image.css" media="all" />

 </head>
<body>
    <div >
        <div id="title_corps">
        <?php 
        print "<p class='name'> Welcome back my administrator   $firstname $lastname hope you change something good   </p>" ;
        ?>
        </div>
        <div id="title_accueil">
        <h1  >Derniers ajouts </h1>
        </div>

        <!-- Récuperation des donneé dans la base de donnée les deux derniers -->
        
        <?php 
        $SQL_SELECT_GAME = " SELECT * FROM game INNER JOIN platform ON game.id_platform = platform.id_platform  ORDER BY id_game DESC LIMIT 2 ";
         $EXE_SQL_SELECT_GAME =  mysqli_query($db,$SQL_SELECT_GAME);
         if (!$EXE_SQL_SELECT_GAME) { // affichge de l'erreur si la resuqetene fonctionne pas
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        else{
            
         while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_GAME)){ // affichage des donnée récupérer
        ?>
        <div class="corps_accueil">;
        <div class="contenant">
        <?php  print "<img class='jaquette_accueil' src='../image/".$donnee['jaquette']."'>";?>
            <div class="texte_contenant" >
                <p class='text_body'>Nom  : <?php echo $donnee['name'];?> </p>
                <p class='text_body'>plateforme : <?php echo $donnee['platform_name'];?> </p>
                <p class='text_body'>date : <?php if ($donnee['release_date']==NULL){
                            echo "pas de date";
                        }
                        else{
                            echo $donnee['release_date'];
                        }
                            ?> </p>

                 <p class='text_body'>Etat : <?php if($donnee['state']==1){
                            echo "neuf";
                        }
                        else {
                            echo "occasion";
                        }
                         ?> </p>
                 <p class='text_body'>prix : <?php echo $donnee['price'];?> &euro; </p>
            </div>
        </div>
    </div>


  <?php 
 }
}
?>      


    </div>
   
</body>
<?php
 include_once "../html/footer.html";
?>
</html>
<?php 

}
?>