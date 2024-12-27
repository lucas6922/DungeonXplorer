<?php
include 'includes/header.php';

?>

<h1>Modifier le chapitre <?php echo $chapitre['CHA_NAME']; ?></h1>
<!-- <pre>
    <?php print_r($chapitre); ?>
</pre> -->
<form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_chapitre_traitement" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="cha_id" value="<?php echo $chapitre['CHA_ID']; ?>">


    <label for="cha_name">Nom du chapitre :</label>
    <input type="text" id="cha_name" name="cha_name" value="<?php echo $chapitre['CHA_NAME']; ?>" required>


    <label for="loo_id">Nom du loot:</label>
    <select name="loo_id" id="loo_id">
        <option value="<?php echo $chapitre['LOO_ID']; ?>"><?php echo $chapitre['LOO_NAME']; ?></option>
        <?php foreach ($loots as $loot): ?>
            <option value="<?php echo $loot['LOO_ID']; ?>"><?php echo $loot['LOO_NAME']; ?></option>
        <?php endforeach; ?>
    </select>


    <label for="cha_content">Contenu du chapitre :</label>
    <textarea id="cha_content" name="cha_content" required><?php echo $chapitre['CHA_CONTENT']; ?></textarea>


    <label for="cha_image">Image :</label>
    <input type="text" id="cha_image" name="cha_image" value="<?php echo $chapitre['CHA_IMAGE']; ?>">

    <button type="submit" class="form-btn">Enregistrer les modifications</button>
</form>


<a href="<?php echo $baseUrl; ?>/pannel_admin/chapitres">Retour à la liste des chapitres</a>


<?php include 'includes/footer.php'; ?>