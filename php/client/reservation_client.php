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
    include_once "../../config/connexion_7_2020.php";
    include_once "../../html/header_client.html";
 
?>

<html>
 <head>
 <link rel="stylesheet" href="../../css/image.css" media="all" />
 <link rel="stylesheet" href="../../css/game.css"/>

 </head>
<body>

<div id="corps">
        <table>
                <tr>
                    <th class="entete_tableau">Nom </th>
                    <th class="entete_tableau">nom du jeu</th>
                    <th class="entete_tableau">platforme</th> 
                    <th class="entete_tableau">Prix (en euros)</th>
                    <th class="entete_tableau">Etat de reservation</th>
                    <th class="entete_tableau">Quantité</th>
                   

                </tr>
                <?php
                    $SQL_SELECT_RESERVATION = " SELECT * FROM reservation 
                    INNER JOIN game ON reservation.id_game = game.id_game 
                    INNER JOIN users ON reservation.id_users = users.id_users 
                    INNER JOIN platform on game.id_platform = platform.id_platform 
                    INNER JOIN state on reservation.id_state = state.id_state
                    where reservation.id_users = '".$_SESSION["id_client"]."' AND  reservation.id_state = '1 OR 2' ";
                    $EXE_SQL_SELECT_RESERVATION = mysqli_query($db, $SQL_SELECT_RESERVATION);
            
                    if (!$EXE_SQL_SELECT_RESERVATION) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }
                while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_RESERVATION)) 
                {
                ?>
                    <form action="../client/cancel.php" method="post">
                    
                        
                        <input type="hidden" name="id_reservation" value=<?php echo $donnee['id_reservation'];?> >
                        <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
                        <input type="hidden" name="id_state" value=<?php echo $donnee['id_state'];?> >
                        <tr>
                        <td class="element_tableau">
                            <?php echo $donnee['user_name'];?> 
                        </td>
                        <td class="element_tableau">
                            <?php echo $donnee['name'];?> 
                        </td>
                        <td class="element_tableau">
                            <?php echo $donnee['platform_name']?>
                        </td>
                        <td class="element_tableau">
                            <?php echo $donnee['price']?>
                        </td>

                        <td class="element_tableau">
                            <?php echo $donnee['reservation_value'];?> 
                        </td>
                        <td class="element_tableau">
                            <?php echo  $donnee['Qte']; ?>
                        </td>
                        

                        <td> <input class="button"type="submit" name="annuler" value="annuler" onclick="return(confirm('Voulez vous vraiment annuler ?'))"></td>
                        
                    </tr>

                 </form>
                <?php
                }
            ?>
        </table>
     </div>





</body>

</html>

<?php 
    }
?>