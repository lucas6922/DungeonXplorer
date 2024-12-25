<?php include 'includes/header.php'; ?>

<h1>Création d'un loot</h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/ajoutLoot" method="POST" enctype="multipart/form-data">


    <label for="loo_name">Nom du loot* :</label>
    <input type="text" id="loo_name" name="loo_name" placeholder="Saisissez le nom du loot" required>



    <label for="loo_quantity">Quantite du loot :</label>
    <input type="number" id="loo_quantity" name="loo_quantity" placeholder="Saisissez la description du loot"></textarea>



    <button type="submit">Créer l'item</button>
</form>

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

<?php include 'includes/footer.php'; ?>