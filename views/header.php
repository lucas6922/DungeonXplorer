<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DungeonXplorer</title>
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <header>
            <h1><a href="index.php" class="titre-DungeonXplorer">DungeonXplorer</a></h1>
            <nav>
                <?php if (!isset($_SESSION['pla_id']) || empty($_SESSION['pla_id'])): ?>
                    <a href="connexion">Connexion</a>
                    <a href="creation_compte">Créer un compte</a>
                <?php else: ?>
                    <a href="deconnexion">Déconnexion</a>
                    <a href="infos_compte">Informations du compte</a>
                <?php endif; ?>
            </nav>
        </header>
        <main>