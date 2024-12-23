<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$baseUrl = '/DungeonXplorer';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer</title>
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/CSS/style.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo $baseUrl; ?>/JS/notif_erreur.js"></script>

</head>

<body>
    <header>
        <h1><a href="./" class="titre-DungeonXplorer">DungeonXplorer</a></h1>
        <nav>
            <?php if (!isset($_SESSION['pla_id']) || empty($_SESSION['pla_id'])): ?>
                <a href="<?php echo $baseUrl; ?>/connexion">Connexion</a>
                <a href="<?php echo $baseUrl; ?>/creation_compte">Créer un compte</a>
            <?php else: ?>
                <a href="<?php echo $baseUrl; ?>/deconnexion">Déconnexion</a>
                <a href="<?php echo $baseUrl; ?>/infos_compte">Informations du compte</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <!--
        <pre>
                <?php
                print_r($_SESSION);
                print_r($_COOKIE);
                ?>
            </pre>
            -->