<?php include 'includes/header.php'; ?>
<h1>TRESORS</h1>

<h2>ITEMS</h2>

<!--affichage des items-->
<?php if (!empty($items)): ?>
    <table>
        <thead>
            <tr>
                <th scope="col">ITE_NAME</th>
                <th scope="col">TYPE</th>
                <th scope="col">ITE_DESCRIPTION</th>
                <th scope="col">ITE_POIDS</th>
                <th scope="col">ITE_VALUE</th>
                <th scope="col">SUPPRESSION</th>
                <th scope="col">MODIFICATION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo $item['ITE_NAME']; ?></td>
                    <td><?php echo $item['TYP_LIBELLE']; ?></td>
                    <td><?php echo $item['ITE_DESCRIPTION']; ?></td>
                    <td><?php echo $item['ITE_POIDS']; ?></td>
                    <td><?php echo $item['ITE_VALUE']; ?></td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/supprimer_item" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="ite_id" value="<?php echo $item['ITE_ID']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet item ?');">Supprimer</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_item" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="ite_id" value="<?php echo $item['ITE_ID']; ?>">
                            <button type="submit">Modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>

<div>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/creation_item">Créer un item</button>
</div>



<!--affichage des loots-->

<h2>LOOTS</h2>
<?php if (!empty($items)): ?>
    <table>
        <thead>
            <tr>
                <th scope="col">LOO_NAME</th>
                <th scope="col">LOO_QUANTITY</th>
                <th scope="col">SUPPRESSION</th>
                <th scope="col">MODIFICATION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($loots as $loot): ?>
                <tr>
                    <td><?php echo $loot['LOO_NAME']; ?></td>
                    <td><?php echo $loot['LOO_QUANTITY']; ?></td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/supprimer_item" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="ite_id" value="<?php echo $item['ITE_ID']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet item ?');">Supprimer</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_item" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="ite_id" value="<?php echo $item['ITE_ID']; ?>">
                            <button type="submit">Modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>

<div>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/creation_loot">Créer un loot</button>
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
<?php include 'includes/footer.php'; ?>