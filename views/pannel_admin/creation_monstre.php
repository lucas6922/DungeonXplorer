<?php include 'includes/header.php'; ?>

<h1>Création d'un Monstre</h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/ajoutMonstre" method="POST" enctype="multipart/form-data">

    <label for="mon_name">Nom du Monstre</label>
    <input type="text" name="mon_name" id="mon_name" placeholder="Saisissez le nom du monstre" required>


    <label for="loo_id">Nom du loot:</label>
    <select name="loo_id" id="loo_id">
        <option value="">Sélectionnez un loot</option>
        <?php foreach ($loots as $loot): ?>
            <option value="<?php echo $loot['LOO_ID']; ?>"><?php echo $loot['LOO_NAME']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="mon_pv">Points de Vie (PV)</label>
    <input type="number" name="mon_pv" id="mon_pv" placeholder="Saisissez les points de vie du monstre" required>

    <label for="mon_mana">Mana</label>
    <input type="number" name="mon_mana" id="mon_mana" placeholder="Saisissez le mana du monstre">

    <label for="mon_initiative">Initiative</label>
    <input type="number" name="mon_initiative" id="mon_initiative" placeholder="Saisissez l'initiative du monstre" required>

    <label for="mon_strength">Force (Strength)</label>
    <input type="number" name="mon_strength" id="mon_strength" placeholder="Saisissez la force du monstre" required>

    <label for="mon_attack">Attaque</label>
    <input type="text" name="mon_attack" id="mon_attack" placeholder="Saisissez l'attaque du monstre ">

    <label for="mon_xp">Expérience (XP)</label>
    <input type="number" name="mon_xp" id="mon_xp" placeholder="Saisissez les points d'expérience donnés par le monstre" required>

    <button type="submit" class="form-btn">Créer Monstre</button>
</form>

<a href="<?php echo $baseUrl; ?>/pannel_admin/monstres">Retour à la liste des monstres</a>

<?php
if (isset($_SESSION['mon_creation_error']) && !empty($_SESSION['mon_creation_error'])) :
?>

    <script>
        afficherErreur("<?= $_SESSION['mon_creation_error'] ?>");
    </script>
<?php
    unset($_SESSION['mon_creation_error']);
endif;
?>

<?php include 'includes/footer.php'; ?>