<?php include 'includes/header.php'; ?>

<h1>Modifier l'item <?php echo $item['ITE_NAME']; ?></h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_item_traitement" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="ite_id" value="<?php echo $item['ITE_ID']; ?>">

    <label for="ite_name">Nom de l'item *:</label>
    <input type="text" id="ite_name" name="ite_name" value="<?php echo $item['ITE_NAME']; ?>" required>

    <label for="ite_description">Description de l'item :</label>
    <textarea id="ite_description" name="ite_description"><?php echo $item['ITE_DESCRIPTION']; ?></textarea>



    <label for="ite_poids">Poids de l'item :</label>
    <input type="number" id="ite_poids" name="ite_poids" value="<?php echo $item['ITE_POIDS']; ?>">



    <label for="ite_value">Valeur de l'item :</label>
    <input type="number" id="ite_value" name="ite_value" value="<?php echo $item['ITE_VALUE']; ?>">



    <label for="typ_id">Type de l'item :</label>
    <select name="typ_id" id="typ_id">
        <option value=" <?php echo $item['TYP_ID']; ?>"><?php echo $item['TYP_LIBELLE']; ?></option>
        <?php foreach ($types as $type): ?>
            <?php if ($type['TYP_ID'] != $item['TYP_ID']): ?>
                <option value="<?php echo $type['TYP_ID']; ?>"><?php echo $type['TYP_LIBELLE']; ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>


    <button type="submit" class="form-btn">Modifier l'item</button>
</form>

<a href="<?php echo $baseUrl; ?>/pannel_admin/tresors">Retour à la liste des tresors</a>


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