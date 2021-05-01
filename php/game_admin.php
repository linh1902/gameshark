<!DOCTYPE html>
<?php
    include_once "../config/connexion_7_2020.php";
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/page_stylesheet.css">
</head>

<body>
<body>
    <header id="entete">
        <div id="titre_banner">
            <img id="logo" src="../image/logo_gameshark.PNG" alt="logo_gameshark">
            <h1 id="title">gameshark</h1>
        </div>
        <ul id="menu">
            <li>
                <a class="titre_menu" href="../php/page_accueil_admin.php">Accueil</a>
            </li>
            <li>
                <a class="titre_menu" href="../php/game_admin.php">Jeux</a>
            </li>
            <li>
                <a class="titre_menu" href="../php/reservation_admin.php">Réservation</a>
            </li>
            <li>
                <a class="titre_menu">Deconnexion</a>
            </li>
        </ul>

    </header>
    <div id="corps">
        <p>page jeux admin</p>

        <a href="add_game.html">
            <input type="button" class="button" value="ajouter">
        </a>
    <?php

        $SQL_SELECT_GAME = " SELECT * FROM game INNER JOIN platform ON game.id_platform = platform.id_platform ";
        $EXE_SQL_SELECT_GAME =  mysqli_query($db,$SQL_SELECT_GAME);

        if (!$EXE_SQL_SELECT_GAME) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
    ?>
    <table>
                <tr>
                    <th>ID</th>
                    <th>Jeu</th>
                    <th>Plate-forme</th>
                   <th>date de sortie</th> 
                   <th>Prix (en euros)</th>
                   <th>Etat</th>
                   <th>Quantité</th>
                   <th></th>
                   <th></th>
                </tr>
                <?php
                
                while($donnee = mysqli_fetch_array($EXE_SQL_SELECT_GAME)) 
                {
                ?>
               
                    <tr>
                        <td><?php echo $donnee['id_game'];?></td>
                        <td><?php echo $donnee['name']?></td>
                        <td><?php echo $donnee['platform_name']?></td>
                        <td><?php if ($donnee['release_date']==NULL){
                            echo "pas de date";
                        }
                        else{
                            echo $donnee['release_date'];
                        }
                            ?></td>
                        <td><?php echo $donnee['price']?></td>
                        <td><?php if($donnee['state']==1){
                            echo "neuf";
                        }
                        else {
                            echo "occasion";
                        }
                         ?></td>
                        <td><input type="number" name="quantity" value=<?php echo  $donnee['quantity']; ?> ></td>
                        <td> <input type="button" name="modifier" value="modifier"></td>
                        <td> <input type="button" name="supprimer" value="supprimer"></td>
                    </tr>
                    <br>
            <?php 
                }
            ?>
            </table>
 

    </div>
    <footer>
        <div>
            <h2 class="titleFooter">Horaire</h2>
            <p class="texte_footer">lundi 9h 18h</p>
            <p class="texte_footer">mardi 9h 18h</p>
            <p class="texte_footer">Mercredi 9h 18h</p>
            <p class="texte_footer">jeudi 9h 18h</p>
            <p class="texte_footer">vendredi 9h 18h</p>
            <p class="texte_footer">Samedi 9h 18h</p>
        </div>

        <div>
            <h2 class="titleFooter">Adresse</h2>
            <p class="texte_footer">8 rue de je ne sai pas</p>
            <p class="texte_footer">85200</p>
            <p class="texte_footer">fontenay le comte</p>
        </div>
        <div>
            <h2 class="titleFooter">Contact</h2>
            <address>
                <a class="contact" href="mailto:gameshark@gmail.com">gameshark@gmail.com</a>
                <br>
                <a  class="contact" href="tel:XXXXXXXX"> XXXXXXXXXX</a>
            </address>
        </div>
    </footer>
</body>

</html>