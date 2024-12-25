<?php include 'includes/header.php'; ?>

<h1>Modifier l'item <?php echo $loot['LOO_NAME']; ?></h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/ajoutItem" method="POST" enctype="multipart/form-data">


    <label for="loo_name">Nom de lu loot *:</label>
    <input type="text" id="loo_name" name="loo_name" value="<?php echo $loot['LOO_NAME']; ?>" required>

    <label for="loo_quantity">Quantite du loot :</label>
    <input type="number" id="loo_quantity" name="loo_quantity" value="<?php echo $loot['LOO_QUANTITY']; ?>">




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