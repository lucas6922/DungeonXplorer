<?php include 'includes/header.php'; ?>

<h1>Modifier l'item <?php echo $loot['LOO_NAME']; ?></h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_loot_traitement" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="loo_id" value="<?php echo $loot['LOO_ID']; ?>">

    <label for="loo_name">Nom du loot *:</label>
    <input type="text" id="loo_name" name="loo_name" value="<?php echo $loot['LOO_NAME']; ?>" required>

    <label for="loo_quantity">Quantite du loot :</label>
    <input type="number" id="loo_quantity" name="loo_quantity" value="<?php echo $loot['LOO_QUANTITY']; ?>">

    <!--tout le contenu du loot-->
    <!-- <?php print_r($loot) ?> -->

    <h2>Items dans le loot :</h2>
    <?php foreach ($loot['ITEMS'] as $index => $item): ?>
        <div class="item">
            <input type="hidden" name="items[<?php echo $index; ?>][ite_id]" value="<?php echo $item['ITE_ID']; ?>">

            <label for="item_<?php echo $index; ?>">Nom de l'item :</label>
            <select id="item_<?php echo $index; ?>" name="items[<?php echo $index; ?>][ite_id]">
                <?php foreach ($items as $option): ?>
                    <option value="<?php echo $option['ITE_ID']; ?>" <?php echo $option['ITE_ID'] == $item['ITE_ID'] ? 'selected' : ''; ?>>
                        <?php echo $option['ITE_NAME']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="item_quantity_<?php echo $index; ?>">Quantité :</label>
            <input type="number" id="item_quantity_<?php echo $index; ?>" name="items[<?php echo $index; ?>][ite_quantity]" value="<?php echo $item['CON_QTE']; ?>">
        </div>
    <?php endforeach; ?>

    <button type="submit" class="form-btn">modifier le loot</button>
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