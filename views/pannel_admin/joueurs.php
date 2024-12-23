<?php include 'includes/header.php'; ?>
<table>
    <thead>
        <tr>
            <th scope="col">PLA_ID</th>
            <th scope="col">PLA_FIRSTNAME</th>
            <th scope="col">PLA_SURNAME</th>
            <th scope="col">PLA_MAIL</th>
            <th scope="col">PLA_PSEUDO</th>
            <th scope="col">ISADMIN</th>
            <th scope="col">SUPRESSION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($joueurs as $joueur): ?>
            <tr>
                <td><?php echo $joueur['PLA_ID']; ?></td>
                <td><?php echo $joueur['PLA_FIRSTNAME']; ?></td>
                <td><?php echo $joueur['PLA_SURNAME']; ?></td>
                <td><?php echo $joueur['PLA_MAIL']; ?></td>
                <td><?php echo $joueur['PLA_PSEUDO']; ?></td>
                <td><?php echo $joueur['ISADMIN']; ?></td>
                <td>
                    <form action="pannel_admin/supprimer_joueur" method="post" id="form-supp-compte-panadm">
                        <input type="hidden" name="pla_id" value="<?php echo $joueur['PLA_ID']; ?>">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>