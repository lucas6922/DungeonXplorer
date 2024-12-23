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
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/CSS/reset.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/CSS/general.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/CSS/style.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/CSS/carousel.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/CSS/formulaire.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/CSS/hero_card.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo $baseUrl; ?>/JS/notif_erreur.js"></script>
    <script src="<?php echo $baseUrl; ?>/JS/carousel.js"></script>
</head>

<body>
    <header>
        <h1><a href="<?php echo $baseUrl; ?>/" class="titre-DungeonXplorer">DungeonXplorer</a></h1>
        <nav>
            <!--  si connecte en tant qu'admin affiche btn pannel admin  -->
            <?php if ($_SESSION['is_admin'] == 1): ?>
                <a href="<?php echo $baseUrl; ?>/pannel_admin/pannel_admin_accueil">Pannel Admin</a>
            <?php endif; ?>
            <!--  si deco affiche btn connexion et creatoin compte  -->
            <?php if (!isset($_SESSION['pla_id']) || empty($_SESSION['pla_id'])): ?>
                <a href="<?php echo $baseUrl; ?>/connexion">Connexion</a>
                <a href="<?php echo $baseUrl; ?>/creation_compte">Créer un compte</a>
            <?php else: ?>
                <!--  sinon btn deconnexin et info compte  -->
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