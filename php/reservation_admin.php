<?php 
session_start();

if(!$_SESSION) {
    // Si la session n'est pas ouverte ...
    echo "probleme de session veuillez vous reconnecter";
    }

else {
?>

<!DOCTYPE html>
<html>
<?php
    include_once "../config/connexion_7_2020.php";
    include_once "../html/header.html";
?>
<body>
    <div id="corps">
        <table>
                <tr>
                    <th>Nom Utilisateur</th>
                    <th>Mail</th>
                    <th>nom du jeu</th>
                   <th>platforme</th> 
                   <th>Prix (en euros)</th>
                   <th>Etat de reservation</th>
                   <th>Quantité</th>
                   <th>quantité disponible</th>

                </tr>
                <?php
                    $SQL_SELECT_RESERVATION = "SELECT id_reservation, users.user_name, users.mail,game.id_game, game.name,reservation.id_state, platform.platform_name, game.price, game.quantity,state.reservation_value, Qte FROM reservation 
                    INNER JOIN game ON reservation.id_game = game.id_game 
                    INNER JOIN users ON reservation.id_users = users.id_users 
                    INNER JOIN platform on game.id_platform = platform.id_platform 
                    INNER JOIN state on reservation.id_state = state.id_state
                    where reservation.id_state = '1' OR reservation.id_state = '2' ";
                    $EXE_SQL_SELECT_RESERVATION = mysqli_query($db, $SQL_SELECT_RESERVATION);
            
                    if (!$EXE_SQL_SELECT_RESERVATION) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }
                while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_RESERVATION)) 
                {
                ?>
                    <form action="action_reservation.php" method="post">
                    
                        
                        <input type="hidden" name="id_reservation" value=<?php echo $donnee['id_reservation'];?> >
                        <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
                        <input type="hidden" name="id_state" value=<?php echo $donnee['id_state'];?> >
                        <tr>
                        <td>
                        <input type="text" name="name" value=<?php echo $donnee['user_name'];?> >
                        </td>
                        <td>
                        <input type="text" name="mail" value=<?php echo $donnee['mail'];?> >
                        </td>
                        <td>
                        <input type="text" name="game_name" value=<?php echo $donnee['name'];?> >
                        </td>
                        <td><?php echo $donnee['platform_name']?></td>

                        <td>
                            <input type="number" name="price" step="any" value=<?php echo $donnee['price']?>> 
                         </td>

                         <td>
                        <input type="text" name="state_reservation" value=<?php echo $donnee['reservation_value'];?> >
                        </td>
                         
                        <td><input type="text" name="quantity" value=<?php echo  $donnee['Qte']; ?> ></td>
                        <td><input type="text" name="quantityAvailable" value=<?php echo  $donnee['quantity']; ?> ></td>

                        <td> <input class="button"type="submit" name="ready" value="ready"></td>
                        <td> <input class="button" type="submit" name="paid"  value="paid"></td>
                    </tr>

                 </form>
                <?php
                }
            ?>
        </table>
     </div>
</body>

<?php 
include_once "../html/footer.html";
?>
</html>

<?php
}
?>