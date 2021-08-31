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
 <link rel="stylesheet" href="../../css/page_stylesheet.css"/>

 </head>
<body>
<form action = "game_client.php" method = "get">
        <input type = "search" name = "mot_clé"  placeholder ="Nom d'un jeu" id = "searchBar">
        <input type = "submit" name = "search" value = "Rechercher" id = "searchButton">
    </form>
   
    <table> <tr>
                    <th></th>
                    <th class="entete_tableau">jaquette</th>
                    <th class="entete_tableau">Jeu</th>
                    <th class="entete_tableau">Plate-forme</th>
                    <th class="entete_tableau">date de sortie</th> 
                    <th class="entete_tableau">Prix (en euros)</th>
                    <th class="entete_tableau">Etat</th>
                    <th class="entete_tableau">Quantité</th>
                   
                </tr>
    <?php 
     // code php pour l'execution de  de la barre de recherche (dans le cas ou l'utilisateur a saisie des mot clé )

    if (isset($_GET["search"])){
    $_GET["mot_clé"] = htmlspecialchars($_GET["mot_clé"]); //pour sécuriser le formulaire contre les failles html
    $keyword = $_GET["mot_clé"];
    $keyword = trim($keyword); //pour supprimer les espaces dans la requête de l'internaute
    $keyword = strip_tags($keyword); //pour supprimer les balises html dans la requête
    
        if (isset($keyword)){
        $keyword = strtolower($keyword); // transformation du texte en minuscule
        $select_search = "SELECT * FROM game INNER JOIN platform ON game.id_platform = platform.id_platform  WHERE game.name LIKE '%".$keyword."%'";
        $exe_select_search = mysqli_query($db,$select_search);
        while($donnee = mysqli_fetch_assoc($exe_select_search)) 
        {
            ?>
            <form action="../client/add_reservation" method="post">
                    <tr>
                        <td class="element_tableau">
                        <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
                        </td>
                        <td class="element_tableau">
                       <?php  print "<img class='jaquette' src='../../image/".$donnee['jaquette']."'>";?>
                        </td>
                        <td class="element_tableau">
                        <?php echo $donnee['name'];?>
                    </td>
                        <td class="element_tableau"><?php echo $donnee['platform_name']?></td>
                        <td class="element_tableau"><?php if ($donnee['release_date']==NULL){
                            echo "pas de date";
                        }
                        else{
                            echo $donnee['release_date'];
                        }
                            ?></td>
                        <td class="element_tableau">
                            <?php echo $donnee['price']?>
                         </td>
                        <td class="element_tableau"><?php if($donnee['state']==1){
                            echo "neuf";
                        }
                        else {
                            echo "occasion";
                        }
                         ?></td>
                        <td class="element_tableau"><?php echo  $donnee['quantity']; ?> </td>
                        <td><input type ="number" name="qteDes" value ="0"></td>
                        <td> <input class="button"type="submit" name="ajouter" value="ajouter"></td>
                        
                    </tr>

                 </form>
            <?php
                }
            }
        }else{ 
            $SQL_SELECT_GAME = " SELECT * FROM game INNER JOIN platform ON game.id_platform = platform.id_platform ";
            $EXE_SQL_SELECT_GAME = mysqli_query($db,$SQL_SELECT_GAME);
                if (!$EXE_SQL_SELECT_GAME) {
                printf("Error: %s\n", mysqli_error($db));
                exit();}
                while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_GAME)) 
                {
                ?>
                    <form action="../client/add_reservation" method="post">
                    <tr>
                        <td class="element_tableau">
                        <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
                        </td>
                        <td class="element_tableau">
                       <?php  print "<img class='jaquette' src='../../image/".$donnee['jaquette']."'>";?>
                        </td>
                        <td class="element_tableau">
                        <?php echo $donnee['name'];?>
                    </td>
                        <td class="element_tableau"><?php echo $donnee['platform_name']?></td>
                        <td class="element_tableau"><?php if ($donnee['release_date']==NULL){
                            echo "pas de date";
                        }
                        else{
                            echo $donnee['release_date'];
                        }
                            ?></td>
                        <td class="element_tableau">
                            <?php echo $donnee['price']?>
                         </td>
                        <td class="element_tableau"><?php if($donnee['state']==1){
                            echo "neuf";
                        }
                        else {
                            echo "occasion";
                        }
                         ?></td>
                        <td class="element_tableau"><?php echo  $donnee['quantity']; ?> </td>
                        <td><input type ="number" name="qteDes" value ="0"></td>
                        <td> <input class="button"type="submit" name="ajouter" value="ajouter"></td>
                        
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