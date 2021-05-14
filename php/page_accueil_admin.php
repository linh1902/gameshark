<!DOCTYPE html>
<?php 
include_once "../html/header.html";
include_once "../html/footer.html";
include_once  "../config/connexion_7_2020.php";
?>
<body>
    
    <div id="corps">
        <div>
        <h1>Derniers ajouts </h1>
        </div>

        <!-- Récuperation des donneé dans la base de donnée les deux derniers -->

        <?php 
        $SQL_SELECT_GAME = " SELECT * FROM game INNER JOIN platform ON game.id_platform = platform.id_platform  ORDER BY id_game DESC LIMIT 2 ";
         $EXE_SQL_SELECT_GAME =  mysqli_query($db,$SQL_SELECT_GAME);
         if (!$EXE_SQL_SELECT_GAME) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        else{
         while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_GAME)){
        ?>
        <div>
        <p>Nom : <?php echo $donnee['name'];?> </p>
        <p>plateforme : <?php echo $donnee['platform_name'];?> </p>
        <p>date : <?php if ($donnee['release_date']==NULL){
                            echo "pas de date";
                        }
                        else{
                            echo $donnee['release_date'];
                        }
                            ?> </p>

        <p>Etat : <?php if($donnee['state']==1){
                            echo "neuf";
                        }
                        else {
                            echo "occasion";
                        }
                         ?> </p>
         <p>prix : <?php echo $donnee['price'];?> &euro; </p>

        </div>


  <?php 
 }
}
?>      


    </div>
   
</body>

</html>