<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
    </head>
    <body>
        <h1> Bienvenue sur le site DungeonXplorer</h1>
        <?php
            if (!isset($_SESSION['pla_id']) || empty($_SESSION['pla_id'])) {
                echo '<button><a href="connexion">Connexion</a></button>
                      <button><a href="creation_compte">Créer un compte</a></button>';
            } else {
                echo '<button><a href="deconnexion">Déconnexion</a></button>';
            }
        ?>
        <button><a href="creation_personnage">Créer un nouveau personnage</a></button>
        <button><a href="personnages">Mes personnages</a></button>
        <button><a href="chapitre">Accéder à l'aventure</a></button>
        <?php
            if (isset($_SESSION['pla_id']) && !empty($_SESSION['pla_id'])) {
                echo '<button><a href="infos_compte">Informations du compte</a></button>';
            }
        ?>
    </body>
</html>