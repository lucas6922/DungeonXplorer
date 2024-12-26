<?php include 'includes/header.php'; ?>

<h1>Création d'un loot</h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/ajoutLoot" method="POST" enctype="multipart/form-data">


    <label for="loo_name">Nom du loot* :</label>
    <input type="text" id="loo_name" name="loo_name" placeholder="Saisissez le nom du loot" required>



    <label for="loo_quantity">Quantite du loot :</label>
    <input type="number" id="loo_quantity" name="loo_quantity" placeholder="Saisissez la description du loot"></textarea>

    <h2>Ajouter des items au loot</h2>
    <div id="items-container">
        <div class="item-entry">
            <label for="item_name_1">Nom de l'item :</label>
            <select id="item_name_1" name="items[0][name]">
                <?php foreach ($items as $item): ?>
                    <option value="<?php echo $item['ITE_ID']; ?>">
                        <?php echo $item['ITE_NAME']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="item_quantity_1">Quantité de l'item :</label>
            <input type="number" id="item_quantity_1" name="items[0][quantity]" placeholder="Quantité de l'item">
        </div>
    </div>

    <button type="button" id="add-item-btn">Ajouter un item</button>
    <button type="submit">Créer le loot</button>
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


<script src="<?php echo $baseUrl; ?>/JS/create_loot.js"></script>
<?php include 'includes/footer.php'; ?>