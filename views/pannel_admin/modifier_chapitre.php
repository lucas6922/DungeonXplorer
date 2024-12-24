<?php
include 'includes/header.php';

?>

<h1>Modifier le chapitre</h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/modifier_chapitre_traitement" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="cha_id" value="<?php echo $chapitre['CHA_ID']; ?>">

    <div>
        <label for="cha_name">Nom du chapitre :</label>
        <input type="text" id="cha_name" name="cha_name" value="<?php echo $chapitre['CHA_NAME']; ?>" required>
    </div>

    <div>
        <label for="cha_content">Contenu du chapitre :</label>
        <textarea id="cha_content" name="cha_content" required><?php echo $chapitre['CHA_CONTENT']; ?></textarea>
    </div>

    <div>
        <label for="cha_image">Image :</label>
        <input type="text" id="cha_image" name="cha_image" value="<?php echo $chapitre['CHA_IMAGE']; ?>">

    </div>


    <button type="submit">Enregistrer les modifications</button>
</form>

<div>
    <a href="<?php echo $baseUrl; ?>/pannel_admin/chapitres">Retour à la liste des chapitres</a>
</div>

<?php include 'includes/footer.php'; ?>