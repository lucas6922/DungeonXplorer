<?php include 'includes/header.php'; ?>

<h1>Bienvenue sur DungeonXplorer !</h1>

<div class="button-accueil">
    <button><a href="creation_personnage">Créer un nouveau personnage</a></button>
    <button><a href="personnages">Mes personnages</a></button>
    <button><a href="chapitre">Accéder à l'aventure</a></button>
</div>


<?php
if (isset($_SESSION['error_message']) || !empty($_SESSION['error_message'])) :
?>

    <script>
        afficherErreur("<?= $_SESSION['error_message'] ?>");
    </script>
<?php
    unset($_SESSION['error_message']);
endif;
?>
<!--
    <pre>
        <?php print_r($_SESSION); ?>
    </pre>
-->

<?php include 'includes/footer.php'; ?>