<?php include 'includes/header.php'; ?>

<h1>Création d'un item</h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/ajoutLoot" method="POST" enctype="multipart/form-data">


    <label for="loo_name">Nom de l'item *:</label>
    <input type="text" id="loo_name" name="loo_name" placeholder="Saisissez le nom de l'item" required>



    <label for="loo_quantity">Description de l'item :</label>
    <input type="number" id="loo_name" name="loo_name" placeholder="Saisissez la description de l'item"></textarea>



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