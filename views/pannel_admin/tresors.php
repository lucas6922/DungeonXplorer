<?php include 'includes/header.php'; ?>
<h1>TRESORS</h1>

<h2>ITEMS</h2>

<!--affichage des items-->
<?php if (!empty($items)): ?>
    <table>
        <thead>
            <tr>
                <th scope="col">NAME</th>
                <th scope="col">TYPE</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">POIDS</th>
                <th scope="col">VALUE</th>
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
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'item: <?php echo $item['ITE_NAME']; ?>  ?');">Supprimer</button>
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


<button><a href="<?php echo $baseUrl; ?>/pannel_admin/creation_item">Créer un item</a></button>




<!--affichage des loots-->

<h2>LOOTS</h2>
<?php if (!empty($loots)): ?>
    <table>
        <thead>
            <tr>
                <th scope="col">LOO_NAME</th>
                <th scope="col">LOO_QUANTITY</th>
                <th scope="col">ITEMS</th>
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
                        <?php if (isset($loot['ITEMS']) && is_array($loot['ITEMS'])): ?>
                            <ul>
                                <?php foreach ($loot['ITEMS'] as $item): ?>
                                    <?php if (isset($item['ITE_NAME'], $item['CON_QTE'])): ?>
                                        <li><?php echo $item['ITE_NAME']; ?> (Quantité : <?php echo $item['CON_QTE']; ?>)</li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            Aucun item
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/supprimer_loot" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="loo_id" value="<?php echo $loot['LOO_ID']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le loot : <?php echo $loot['LOO_NAME']; ?> ?');">Supprimer</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_loot" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="loo_id" value="<?php echo $loot['LOO_ID']; ?>">
                            <button type="submit">Modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>

<div>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/creation_loot">Créer un loot</a></button>
</div>

<!-- <pre><?php print_r($loots); ?></pre> -->
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