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
<head>
    <link rel="stylesheet" href="../css/game.css"/>
</head>
<body>
   
    <div id="corps">
         <!-- INSERTION DE LA BARRE DE RECHERCHE -->

    <form action = "reservation_admin.php" method = "get">
        <input type = "search" name = "mot_clé"  placeholder="mail d'un client" id = "searchBar">
        <input type = "submit" name = "search" value = "Rechercher"  id = "searchButton">
    </form>
        <table>
                <tr>
                    <th class="entete_tableau">Mail</th>
                    <th class="entete_tableau">Nom du jeu</th>
                    <th class="entete_tableau">Platforme</th> 
                    <th class="entete_tableau">Prix (en euros)</th>
                    <th class="entete_tableau">Etat de reservation</th>
                    <th class="entete_tableau">Quantité</th>
                    <th class="entete_tableau">Quantité disponible</th>

                </tr>
                <?php 
    // code php pour l'execution de  de la barre de recherche (dans le cas ou l'utilisateur a saisie des mot clé )

    if (isset($_GET["search"])){
    $_GET["mot_clé"] = htmlspecialchars($_GET["mot_clé"]); // sécuriser le formulaire contre les failles html
    $keyword = $_GET["mot_clé"];
    $keyword = trim($keyword); // supprimer les espaces dans la requête de l'internaute
    $keyword = strip_tags($keyword); // supprimer les balises html dans la requête
    
        if (isset($keyword)){
        $keyword = strtolower($keyword); // transformation du texte en minuscule
        // requête SQL pour la barre de recherche
        $select_search = "SELECT id_reservation, users.user_name, users.mail,game.id_game, game.name,reservation.id_state, platform.platform_name, game.price, game.quantity,state.reservation_value, Qte FROM reservation 
        INNER JOIN game ON reservation.id_game = game.id_game 
        INNER JOIN users ON reservation.id_users = users.id_users 
        INNER JOIN platform on game.id_platform = platform.id_platform 
        INNER JOIN state on reservation.id_state = state.id_state  WHERE users.mail LIKE '".$keyword."%' AND reservation.id_state != '4'";
        $exe_select_search = mysqli_query($db,$select_search); 
        
        // récuperation des donnée et affichage sur la page
        while($donnee = mysqli_fetch_assoc($exe_select_search))
       
        {
        ?>
            <form action="action_reservation.php" method="post">
                    
                        
            <input type="hidden" name="id_reservation" value=<?php echo $donnee['id_reservation'];?> >
            <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
            <input type="hidden" name="id_state" value=<?php echo $donnee['id_state'];?> >
            <tr>
            <td class="element_tableau">
                <?php echo $donnee['mail'];?>
            </td>
            <td class="element_tableau">
                <?php echo $donnee['name'];?>
            </td>
            <td class="element_tableau">
                <?php echo $donnee['platform_name']?>
            </td>
            <td class="element_tableau">
                <?php echo $donnee['price'];?>
             </td>

             <td class="element_tableau">
                <?php echo $donnee['reservation_value'];?> 
            </td>
             
            <td class="element_tableau">
                <input class="element_tableau" type="text" name="quantityAvailable" readonly value=<?php echo  $donnee['Qte'];?>>
            </td>
            <td class="element_tableau">
                <input  class="element_tableau" type="text" name="quantity" readonly value=<?php echo  $donnee['quantity'];?>>
            </td>
            <td> <input class="button"type="submit" name="ready" value="Prêt" onclick="return(confirm('Etes-vous sûr que la commande est prête ?'));"></td>
            <td> <input class="button" type="submit" name="paid"  value="Payé / Annuler" onclick="return(confirm('Etes-vous sûr que la commande a été payer ?'));"></td>
        </tr>

        </form>
        <?php
            }
        }
        // Cas où rien n'a ete inscrit dans la abrre de recherche, affichage complet de tout les jeux 
         }else{
                    // requête de selection complete des jeux 
                    $SQL_SELECT_RESERVATION = "SELECT id_reservation, users.user_name, users.mail,game.id_game, game.name,reservation.id_state, platform.platform_name, game.price, game.quantity,state.reservation_value, Qte FROM reservation 
                    INNER JOIN game ON reservation.id_game = game.id_game 
                    INNER JOIN users ON reservation.id_users = users.id_users 
                    INNER JOIN platform on game.id_platform = platform.id_platform 
                    INNER JOIN state on reservation.id_state = state.id_state
                    where reservation.id_state != '4' ";
                    $EXE_SQL_SELECT_RESERVATION = mysqli_query($db, $SQL_SELECT_RESERVATION);

                    if (!$EXE_SQL_SELECT_RESERVATION) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }
                //  Recuperation des donnée et affichage 
                while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_RESERVATION)) 
                {
                ?>
                    <form action="action_reservation.php" method="post">
                    
                        
                        <input type="hidden" name="id_reservation" value=<?php echo $donnee['id_reservation'];?> >
                        <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
                        <input type="hidden" name="id_state" value=<?php echo $donnee['id_state'];?> >
                        <tr>
                        <td class="element_tableau">
                            <?php echo $donnee['mail'];?>
                        </td>
                        <td class="element_tableau">
                            <?php echo $donnee['name'];?>
                        </td>
                        <td class="element_tableau">
                            <?php echo $donnee['platform_name']?>
                        </td>
                        <td class="element_tableau">
                            <?php echo $donnee['price'];?>
                         </td>

                         <td class="element_tableau">
                            <?php echo $donnee['reservation_value'];?> 
                        </td>
                         
                        <td class="element_tableau">
                            <input class="element_tableau" type="text" name="quantityAvailable" readonly value=<?php echo  $donnee['Qte'];?>>
                        </td>
                        <td class="element_tableau">
                            <input  class="element_tableau" type="text" name="quantity" readonly value=<?php echo  $donnee['quantity'];?>>
                        </td>
                        <td> <input class="button"type="submit" name="ready" value="Prêt" onclick="return(confirm('Etes-vous sûr que la commande est prête ?'));"></td>
                        <td> <input class="button" type="submit" name="paid"  value="Payé / Annuler" onclick="return(confirm('Etes-vous sûr que la commande a été payer ?'));"></td>
                    </tr>

                 </form>
                <?php
                }
            }
            ?>
        </table>
     </div>
</body>


</html>
<?php
  } 
  ?>   
