<?php
include 'includes/header.php';
?>

<h1>Modifier le monstre <?php echo $monstre['MON_NAME']; ?></h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_monstre_traitement" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="mon_id" value="<?php echo $monstre['MON_ID']; ?>">


    <label for="mon_name">Nom du monstre :</label>
    <input type="text" id="mon_name" name="mon_name" value="<?php echo $monstre['MON_NAME']; ?>" required>

    <label for="loo_id">Nom du loot:</label>
    <select name="loo_id" id="loo_id">
        <option value="<?php echo $monstre['LOO_ID']; ?>"><?php echo $monstre['LOO_NAME']; ?></option>
        <?php foreach ($loots as $loot): ?>
            <option value="<?php echo $loot['LOO_ID']; ?>"><?php echo $loot['LOO_NAME']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="mon_pv">Points de vie :</label>
    <input type="number" id="mon_pv" name="mon_pv" value="<?php echo $monstre['MON_PV']; ?>" required>



    <label for="mon_mana">Points de mana :</label>
    <input type="number" id="mon_mana" name="mon_mana" value="<?php echo $monstre['MON_MANA']; ?>">



    <label for="mon_initiative">Initiative :</label>
    <input type="number" id="mon_initiative" name="mon_initiative" value="<?php echo $monstre['MON_INITIATIVE']; ?>" required>



    <label for="mon_strength">Force :</label>
    <input type="number" id="mon_strength" name="mon_strength" value="<?php echo $monstre['MON_STRENGTH']; ?>" required>



    <label for="mon_attack">Attaque :</label>
    <input type="text" id="mon_attack" name="mon_attack" value="<?php echo $monstre['MON_ATTACK']; ?>">



    <label for="mon_xp">XP :</label>
    <input type="number" id="mon_xp" name="mon_xp" value="<?php echo $monstre['MON_XP']; ?>">


    <button type="submit">Enregistrer les modifications</button>
</form>


<a href="<?php echo $baseUrl; ?>/pannel_admin/monstres">Retour à la liste des monstres</a>


<?php include 'includes/footer.php'; ?>