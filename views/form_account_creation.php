<?php
    // form_account_creation.php
    // formulaire de création de compte

    session_start();

    $nom = isset($_SESSION['nom']) && !empty($_SESSION['nom']) ? $_SESSION['nom'] : '';
    $prenom = isset($_SESSION['prenom']) && !empty($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
    $pseudo = isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo']) ? $_SESSION['pseudo'] : '';
    $email = isset($_SESSION['email']) && !empty($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création de compte</title>
    </head>
    <body>
        <form action="traitement_creation_compte" method="POST">
            <label for="nom">Votre nom</label>
            <br>
            <?php
                echo '<input type="text" name="nom" size="17" placeholder="Saisissez votre nom" value="' . $nom . '">';
            ?>
            <br>
            <br>
            <label for="prenom">Votre prénom</label>
            <br>
            <?php
                echo '<input type="text" name="prenom" size="17" placeholder="Saisissez votre prénom" value="' . $prenom . '">';
            ?>
            <br>
            <br>
            <label for="pseudo">Votre pseudo</label>
            <br>
            <?php
                echo '<input type="text" name="pseudo" size="17" placeholder="Saisissez votre pseudo" value="' . $pseudo . '">';
            ?>
            <br>
            <br>
            <label for="email">Votre email</label>
            <br>
            <?php
                echo '<input type="text" name="email" size="30" placeholder="Saisissez votre adresse email" value="' . $email . '">';
            ?>
            <br>
            <br>
            <label for="password">Votre mot de passe</label>
            <br>
            <input type="password" name="password" size="30" placeholder="Saisissez votre mot de passe">
            <br>
            <br>
            <button type="submit">Envoyer</button>

            <?php
                // affichage des erreurs

                if (isset($_SESSION['account_creation_error']) && !empty($_SESSION['account_creation_error'])) {
                    echo $_SESSION['account_creation_error'];
                }

                $_SESSION['nom'] = null;
                $_SESSION['prenom'] = null;
                $_SESSION['pseudo'] = null;
                $_SESSION['email'] = null;
                $_SESSION['account_creation_error'] = null;
            ?>
        </form>
    </body>
</html>