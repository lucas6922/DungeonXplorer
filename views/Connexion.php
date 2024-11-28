<?php
    // Connexion.php
    // formulaire de connexion à un compte existant

    session_start();

    $pseudoOuEmail = isset($_SESSION['pseudoOuEmail']) && !empty($_SESSION['pseudoOuEmail']) ? $_SESSION['pseudoOuEmail'] : '';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
    </head>
    <body>
        <h1>Connexion</h1>

        <form action="traitement_connexion" method="POST">
            <label for="pseudoOuEmail">Votre pseudo ou adresse email</label>
            <br>
            <?php
                echo '<input type="text" name="pseudoOuEmail" size="30" placeholder="Saisissez votre pseudo / email" value="' . $pseudoOuEmail . '">';
            ?>
            <br>
            <br>
            <label for="password">Votre mot de passe</label>
            <br>
            <input type="password" name="password" size="30" placeholder="Saisissez votre mot de passe">
            <br>
            <br>
            <button type="submit">Se connecter</button>

            <?php
                // affichage des erreurs

                if (isset($_SESSION['connexion_error']) && !empty($_SESSION['connexion_error'])) {
                    echo $_SESSION['connexion_error'];
                }

                $_SESSION['pseudoOuEmail'] = null;
                $_SESSION['connexion_error'] = null;
            ?>
        </form>

        <br>
        <br>
        <button><a href="creation_compte">Créer un compte</a></button>
    </body>
</html>