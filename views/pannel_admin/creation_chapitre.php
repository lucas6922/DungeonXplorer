<?php include 'includes/header.php'; ?>

<h1>Création d'un chapitre</h1>

<form action="<?php echo $baseUrl; ?>/pannel_admin/ajoutChapitre" method="POST" enctype="multipart/form-data">




    <label for="cha_name">Titre du chapitre</label>

    <input type="text" name="cha_name" placeholder="Saisissez le titre du chapitre" required>


    <label for="loo_id">Nom du loot:</label>
    <select name="loo_id" id="loo_id">
        <option value="">Sélectionnez un loot</option>
        <?php foreach ($loots as $loot): ?>
            <option value="<?php echo $loot['LOO_ID']; ?>"><?php echo $loot['LOO_NAME']; ?></option>
        <?php endforeach; ?>
    </select>


    <label for="cha_content">Contenu du chapitre</label>

    <textarea id="cha_content" name="cha_content" placeholder="Saisissez la description du chapitre" required></textarea>


    <label for="cha_image">Image du chapitre</label>

    <input type="text" name="cha_image" placeholder="Saisissez le nom de l'image du chapitre">


    <button type="submit" class="form-btn">Valider</button>
</form>

<?php
if (isset($_SESSION['chap_creation_error']) || !empty($_SESSION['chap_creation_error'])) :
    //print_r($_SESSION['chap_creation_error']);
?>

    <script>
        afficherErreur("<?= $_SESSION['chap_creation_error'] ?>");
    </script>
<?php
    unset($_SESSION['chap_creation_error']);
endif;
?>

<?php include 'includes/footer.php'; ?>