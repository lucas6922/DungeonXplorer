<?php include 'includes/header.php'; ?>

<h1>CHAPITRES</h1>
<?php if (!empty($chapitres)): ?>
    <table>
        <thead>
            <tr>
                <th scope="col">NAME</th>
                <th scope="col">LOOT</th>
                <th scope="col">CONTENT</th>
                <th scope="col">IMAGE</th>
                <th scope="col">SUPRESSION</th>
                <th scope="col">MODIFICATION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chapitres as $chapitre): ?>
                <tr>
                    <td><?php echo $chapitre['CHA_NAME']; ?></td>
                    <td><?php echo $chapitre['LOO_NAME']; ?></td>
                    <td><?php echo $chapitre['CHA_CONTENT']; ?></td>
                    <td>
                        <?php if (!empty($chapitre['CHA_IMAGE'])): ?>
                            <img src="<?php echo $baseUrl; ?>/Images/<?php echo $chapitre['CHA_IMAGE']; ?>" alt="Image du chapitre">
                        <?php else: ?>
                            Pas d'image
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/supprimer_chapitre" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="cha_id" value="<?php echo $chapitre['CHA_ID']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le chapitre: <?php echo $chapitre['CHA_NAME']; ?> ?');">Supprimer</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_chapitre" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="cha_id" value="<?php echo $chapitre['CHA_ID']; ?>">
                            <button type="submit">modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>

<div>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/creation_chapitre">Créer un chapitre</a></button>
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