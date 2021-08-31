<?php
    session_start();

    if(!$_SESSION) {
        // Si la session n'est pas ouverte ...
        echo ("<script LANGUAGE='JavaScript'>
          window.alert('Erreur veuillez vous connectez avant');
          window.location.href='http://localhost/gameshark/html/login.html';
       </script>");
        exit();
        }
        
    // si la connexion est ouverte
    else {
?>


<!DOCTYPE html>
<?php
    include_once "../config/connexion_7_2020.php";
    include_once "../html/header.html";
    
 
?>

 <html>
 <head>
    <!--  insertion des page CSS -->
 <link rel="stylesheet" href="../css/image.css" media="all" />
 <link rel="stylesheet" href="../css/game.css"/>

 </head>
<body>
  
   
    <div id="corps">

        <!--   INSERTION BOUTTON AJOUT -->

        <div id="ajouter">
        <a href="../html/form_add_game.php">
            <input type="button" class="add" value="Add">
        </a>
    </div>

    <!-- INSERTION DE LA BARRE DE RECHERCHE -->

    <form action = "game_admin.php" method = "get">
        <input type = "search" name = "mot_clé"  id = "searchBar" placeholder="Nom d'un jeu">
        <input type = "submit" name = "search" value = "Rechercher" id = "searchButton">
    </form>
    <table>
        <tr>
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
        if (!$exe_select_search) {
            printf("Error: %s\n", mysqli_error($db));
            exit();}
        while($donnee = mysqli_fetch_assoc($exe_select_search)) 
        {
        ?>
            <form action="modif.php" method="post">
            <tr>
                <td class="element_tableau">
                <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
                </td>
                <td class="element_tableau">
                <?php  print "<img class='jaquette' src='../image/".$donnee['jaquette']."'>";?>
                </td>
                <td class="element_tableau">
                <input type="text" name="name"  value=<?php echo $donnee['name'];?> >
                </td>
                <td class="element_tableau"><?php echo $donnee['platform_name']?></td>
                <td class="element_tableau"><?php if ($donnee['release_date']==NULL){
                    print "<p class='element_tableau'> date indispo </p>";
                }
                else{
                    $date= $donnee['release_date'];
                    print "<p class='element_tableau'> $date </p>";
                }
                    ?></td>
                <td class="element_tableau">
                    <input type="number" name="price" step="any" value=<?php echo $donnee['price']?>> 
                 </td>
                <td><?php if($donnee['state']==1){
                    print "<p class='element_tableau'> neuf </p>";
                }
                else {
                    print "<p class='element_tableau'> occasion </p>";
                }
                 ?></td>
                <td><input type="number" name="quantity" value=<?php echo  $donnee['quantity']; ?> ></td>
                <td> <input class="button"type="submit" name="modifier" value="modifier" onclick="return(confirm('les modification sont bonne ?'))"></td>
                <td> <input class="button" type="submit" name="supprimer"  value="supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"></td>
            </tr>

         </form>
        <?php
            } 
        }

    }else{
        
        // Cas ou l'utilisateur n'a pas saisie de mot dans la barre de recherche

        $SQL_SELECT_GAME = " SELECT * FROM game INNER JOIN platform ON game.id_platform = platform.id_platform ";
        $EXE_SQL_SELECT_GAME = mysqli_query($db,$SQL_SELECT_GAME);

        

        if (!$EXE_SQL_SELECT_GAME) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
    ?>
    
                <?php
                
                while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_GAME)) 
                {
                ?>
                    <form action="modif.php" method="post">
                    <tr>
                        <td class="element_tableau">
                        <input type="hidden" name="id_game" value=<?php echo $donnee['id_game'];?> >
                        </td>
                        <td class="element_tableau">
                       <?php  print "<img class='jaquette' src='../image/".$donnee['jaquette']."'>";?>
                        </td>
                        <td class="element_tableau">
                        <input type="text" name="name"  value=<?php echo $donnee['name'];?> >
                    </td>
                        <td class="element_tableau"><?php echo $donnee['platform_name']?></td>
                        <td class="element_tableau"><?php if ($donnee['release_date']==NULL){
                            print "<p class='element_tableau'> date indispo </p>";
                        }
                        else{
                            $date= $donnee['release_date'];
                            print "<p class='element_tableau'> $date </p>";
                        }
                            ?></td>
                        <td class="element_tableau">
                            <input type="number" name="price" step="any" value=<?php echo $donnee['price']?>> 
                         </td>
                        <td><?php if($donnee['state']==1){
                            print "<p class='element_tableau'> neuf </p>";
                        }
                        else {
                            print "<p class='element_tableau'> occasion </p>";
                        }
                         ?></td>
                        <td><input type="number" name="quantity" value=<?php echo  $donnee['quantity']; ?> ></td>
                        <td> <input class="button"type="submit" name="modifier" value="modifier" onclick="return(confirm('les modification sont bonne ?'))"></td>
                        <td> <input class="button" type="submit" name="supprimer"  value="supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"></td>
                    </tr>

                 </form>
            <?php 
                }
            ?>
            </table>
              
        
    
   <?php 
    }
    ?>
    </div>
    <?php 
}
?>    

</body>


