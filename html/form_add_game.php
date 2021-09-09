<?php
  
  include_once "../config/connexion_7_2020.php";

  // requete de recuperation des platform
  $SQL_SELECT_PLATFORM = " SELECT * FROM platform";
  $EXE_SQL_SELECT_PLATFORM =  mysqli_query($db,$SQL_SELECT_PLATFORM);

?>



<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/add_game.css">
</head>

<body>
    <div>
        <h1 id="title2"> Ajout d'un jeu </h1>
    </div>
    <div id="addGame">
        <!--  Formulaire d'ajout  de jeux   -->
        <form action="../php/add_game.php" method="POST">

            <label class="text">Nom du jeux</label>
            <input type="text" placeholder="Entrer le nom du jeux" name="nom" class="input" required>
            <label class="text">Image jaquette</label>
            <input type="file" name="img" class="input" accept=".jpg, .jpeg, .png" multiple required>
            <fieldset>
                <legend class="radio">Plateforme</legend>
                <?php
                // affichage des donnée de plateforme récupérer
                while($donnee = mysqli_fetch_assoc($EXE_SQL_SELECT_PLATFORM))
                {
                    print "<input type='radio' name='plateforme' value=".$donnee['id_platform']." class='radio' checked> <label class='text'>".$donnee['platform_name']."</label>";
                } ?>
                
            </fieldset>
            <label class="text">Date de sortie</label>
            <input type="date" placeholder="date de sortie" name="release" class="input">

            <label class="text">Prix</label>
            <input type="number" placeholder="Entrer votre prix" name="price" class="input" step="any" required>

            <fieldset>
                <legend class="text">Etat</legend>
            
                <input type="radio" name="state" value="1" class="radio" checked>
                <label class ="text">Neuf</label>
                <input type="radio" name="state" value="2" class="radio">
                <label class="radio">Occasion</label>

            </fieldset>

            <label class="text">quantité</label>
            <input type="number" placeholder="Entrer la quantité" name="qte" class="input" min="1" max="100" required>
            
            <input type="submit" id="send" class="button" value="Ajouter">


        </form>
    </div>
</body>

</html>