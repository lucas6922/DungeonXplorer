<?php
    // form_account_creation.php
    // formulaire de création de compte

    $name = isset($_SESSION['name']) && !empty($_SESSION['name']) ? $_SESSION['name'] : '';
    $image = isset($_SESSION['image']) && !empty($_SESSION['image']) ? $_SESSION['image'] : '';
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
                echo '<input type="text" name="name" size="17" placeholder="Saisissez le nom" value="' . $nom . '">';
            ?>
            <br>
            <br>
            <label for="prenom">Choisir une image :</label>
            <br>
            <?php
                echo '<input type="text" name="prenom" size="17" placeholder="Saisissez votre prénom" value="' . $prenom . '">';
            ?>
            <br>
            <br>
            <label for="prenom">Choisir une classe :</label>
            <br>
            <?php
                echo '<input type="text" name="prenom" size="17" placeholder="Saisissez votre prénom" value="' . $prenom . '">';
            ?>
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