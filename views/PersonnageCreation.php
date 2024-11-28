<?php
    // form_account_creation.php
    // formulaire de création de compte

    $name = isset($_SESSION['name']) && !empty($_SESSION['name']) ? $_SESSION['name'] : '';
    $image = isset($_SESSION['image']) && !empty($_SESSION['image']) ? $_SESSION['image'] : '';
    $classe = isset($_SESSION['classe']) && !empty($_SESSION['classe']) ? $_SESSION['classe'] : '';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création de compte</title>
    </head>
    <body>
        <h1></h1>
        <form action="traitement_creation_personnage" method="POST">
            <label for="name">Nom du personnage :</label>
            <br>
            <?php
                echo '<input type="text" name="name" size="17" placeholder="Saisissez le nom" value="' . $name . '">';
            ?>
            <br>
            <br>
            <label for="image">Choisir une image :</label>
            <br>
            <input type="radio" name="classe" class= "imageNouveauPersonnage" id="guerrier"> <img src="Images/Berserker.jpg" alt="guerrier">
            <input type="radio" name="classe" class= "imageNouveauPersonnage" id="magicienne"> <img src="Images/Magician01.jpg" alt="magicienne">
            <input type="radio" name="classe" class= "imageNouveauPersonnage" id="magicien"> <img src="Images/Magician02.jpg" alt="magicien">
            <input type="radio" name="classe" class= "imageNouveauPersonnage" id="voleur"> <img src="Images/Thief.jpg" alt="voleur">
            <br>
            <br>
            <label for="classe">Choisir une classe :</label>
            <br>

            <?php foreach ($nom as $classes): ?>
                <input type="radio" name="classe" id="<?php echo $nom; ?>"> <label for="<?php echo $nom; ?>"><?php echo $nom; ?></label><br>
            <?php endforeach; ?>

            <br>
            <br>
            <button type="submit">Envoyer</button>

            <?php
                // affichage des erreurs

                if (isset($_SESSION['account_creation_error']) && !empty($_SESSION['account_creation_error'])) {
                    echo $_SESSION['account_creation_error'];
                }
            ?>
        </form>
    </body>
</html>