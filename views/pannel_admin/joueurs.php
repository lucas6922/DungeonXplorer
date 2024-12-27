<?php include 'includes/header.php'; ?>
<h1>JOUEURS</h1>
<?php if (!empty($joueurs)): ?>
    <table>
        <thead>
            <tr>
                <th scope="col">FIRSTNAME</th>
                <th scope="col">SURNAME</th>
                <th scope="col">MAIL</th>
                <th scope="col">PSEUDO</th>
                <th scope="col">ISADMIN</th>
                <th scope="col">SUPRESSION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($joueurs as $joueur): ?>
                <tr>
                    <td><?php echo $joueur['PLA_FIRSTNAME']; ?></td>
                    <td><?php echo $joueur['PLA_SURNAME']; ?></td>
                    <td><?php echo $joueur['PLA_MAIL']; ?></td>
                    <td><?php echo $joueur['PLA_PSEUDO']; ?></td>
                    <td><?php echo $joueur['ISADMIN']; ?></td>
                    <td>
                        <form action="<?php echo $baseUrl; ?>/pannel_admin/supprimer_joueur" method="post" class="form-supp-pannel-panadm">
                            <input type="hidden" name="pla_id" value="<?php echo $joueur['PLA_ID']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le joueur: <?php echo $joueur['PLA_PSEUDO']; ?> ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>

<div>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/creation_compte_admin">Créer un compte admin</button>
</div>
<?php include 'includes/footer.php'; ?>