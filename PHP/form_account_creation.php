<?php
    // form_account_creation.php
    // formulaire de création de compte
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création de compte</title>
    </head>
    <body>
        <form action="create_account.php" method="POST">
            <label for="nom">Votre nom</label>
            <br>
            <input type="text" name="nom" size="17" placeholder="Saisissez votre nom">
            <br>
            <br>
            <label for="prenom">Votre prénom</label>
            <br>
            <input type="text" name="prenom" size="17" placeholder="Saisissez votre prénom">
            <br>
            <br>
            <label for="email">Votre email</label>
            <br>
            <input type="text" name="email" size="30" placeholder="Saisissez votre adresse email">
            <br>
            <br>
            <label for="password">Votre mot de passe</label>
            <br>
            <input type="password" name="password" size="30" placeholder="Saisissez votre mot de passe">
            <br>
            <br>
            <button type="submit">Envoyer</button>
        </form>
    </body>
</html>