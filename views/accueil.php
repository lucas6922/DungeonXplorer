<?php include 'includes/header.php'; ?>

<h2>Bienvenue sur DungeonXplorer !</h2>

<div class="button-accueil">
    <button><a href="creation_personnage">Créer un nouveau personnage</a></button>
    <button><a href="personnages">Mes personnages</a></button>
    <button><a href="chapitre">Accéder à l'aventure</a></button>
</div>
<!--
    <pre>
        <?php print_r($_SESSION); ?>
    </pre>
-->
<?php if ($_SESSION['is_admin'] == 1): ?>
    <button><a href="pannel_admin/pannel_admin.php">Pannel Admin</a></button>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>