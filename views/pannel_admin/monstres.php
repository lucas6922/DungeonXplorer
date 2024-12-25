<?php include 'includes/header.php'; ?>
<h1>MONSTRES</h1>
<?php if (!empty($monsters)): ?>
    <table>
        <thead>
            <tr>
                <th scope="col">MON_NAME</th>
                <th scope="col">LOOT</th>
                <th scope="col">MON_PV</th>
                <th scope="col">MON_MANA</th>
                <th scope="col">MON_INITIATIVE</th>
                <th scope="col">MON_STRENGTH</th>
                <th scope="col">MON_ATTACK</th>
                <th scope="col">MON_XP</th>
                <th scope="col">SUPPRESSION</th>
                <th scope="col">MODIFICATION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($monsters as $monster): ?>
                <tr>
                    <td><?php echo $monster['MON_NAME']; ?></td>
                    <td><?php echo $monster['LOO_NAME']; ?></td>
                    <td><?php echo $monster['MON_PV']; ?></td>
                    <td><?php echo $monster['MON_MANA']; ?></td>
                    <td><?php echo $monster['MON_INITIATIVE']; ?></td>
                    <td><?php echo $monster['MON_STRENGTH']; ?></td>
                    <td><?php echo $monster['MON_ATTACK']; ?></td>
                    <td><?php echo $monster['MON_XP']; ?></td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/supprimer_monstre" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="mon_id" value="<?php echo $monster['MON_ID']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce monstre ?');">Supprimer</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_monstre" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="mon_id" value="<?php echo $monster['MON_ID']; ?>">
                            <button type="submit">Modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>

<div>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/creation_monstre">Créer un monstre</button>
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