<?php
    session_start();

    if(!$_SESSION) {
        // Si la session n'est pas ouverte ...
        echo "probleme de session veuillez vous reconnecter";
        }
    
    else {
?>


<!DOCTYPE html>
<?php
    include_once "../config/connexion_7_2020.php";
    include_once "../html/header_client.html";
 
?>

<html>
 <head>
 <link rel="stylesheet" href="../css/image.css" media="all" />

 </head>
<body>
   
    <div id="corps">

        <a href="../html/form_add_game.php">
            <input type="button" class="button" value="ajouter">
        </a>
    <?php

        $SQL_SELECT_GAME = " SELECT * FROM game INNER JOIN platform ON game.id_platform = platform.id_platform ";
        $EXE_SQL_SELECT_GAME = mysqli_query($db,$SQL_SELECT_GAME);

        

        if (!$EXE_SQL_SELECT_GAME) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
    ?>
    <table>
                <tr>
                    <th>ID</th>
                    <th>jaquette</th>
                    <th>Jeu</th>
                    <th>Plate-forme</th>
                   <th>date de sortie</th> 
                   <th>Prix (en euros)</th>
                   <th>Etat</th>
                   <th>Quantité restant</th>

                   <th>Quantité désiré</th>
                   <th></th>
                </tr>
                <?php
                
                while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_GAME)) 
                {
                ?>
                    <form action="../client/add_reservation" method="post">
                    <tr>
                        <td>
                        <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
                        </td>
                        <td>
                       <?php  print "<img class='jaquette' src='../image/".$donnee['jaquette']."'>";?>
                        </td>
                        <td>
                        <input type="text" name="name" value=<?php echo $donnee['name'];?> >
                    </td>
                        <td><?php echo $donnee['platform_name']?></td>
                        <td><?php if ($donnee['release_date']==NULL){
                            echo "pas de date";
                        }
                        else{
                            echo $donnee['release_date'];
                        }
                            ?></td>
                        <td>
                            <input type="text" name="price" step="any" value=<?php echo $donnee['price']?>> 
                         </td>
                        <td><?php if($donnee['state']==1){
                            echo "neuf";
                        }
                        else {
                            echo "occasion";
                        }
                         ?></td>
                        <td><input type="text" name="quantity" value=<?php echo  $donnee['quantity']; ?> ></td>
                        <td><input type ="number" name="qteDes" value ="0"></td>
                        <td> <input class="button"type="submit" name="modifier" value="modifier"></td>
                        <td> <input class="button" type="submit" name="supprimer"  value="supprimer"></td>
                    </tr>

                 </form>
            <?php 
                }
            ?>
            </table>
              

    </div>
   
</body>
<?php include_once "../html/footer.html"; ?>
</html>

<?php 
    }
?>