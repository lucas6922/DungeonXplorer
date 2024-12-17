<?php
    // infos_compte.php
    // informations sur le compte

    session_start();

    $prenom = isset($_SESSION['pla_firstname']) && !empty($_SESSION['pla_firstname']) ? $_SESSION['pla_firstname'] : '';
    $nom = isset($_SESSION['pla_surname']) && !empty($_SESSION['pla_surname']) ? $_SESSION['pla_surname'] : '';
    $pseudo = isset($_SESSION['pla_pseudo']) && !empty($_SESSION['pla_pseudo']) ? $_SESSION['pla_pseudo'] : '';
    $email = isset($_SESSION['pla_mail']) && !empty($_SESSION['pla_mail']) ? $_SESSION['pla_mail'] : '';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Informations du compte</title>
    </head>
    <body>
        <h1>Informations du compte</h1>
        <?php
            echo 'Prénom : ' . $prenom;
            echo '<br>';
            echo 'Nom : ' . $nom;
            echo '<br>';
            echo 'Pseudo : ' . $pseudo;
            echo '<br>';
            echo 'Adresse email : ' . $email;
        ?>
        <br>
        <br>
        <button><a href="supprimer_compte">Supprimer le compte</a></button>
    </body>
</html>