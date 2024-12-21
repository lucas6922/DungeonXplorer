<?php
include 'includes/header.php';
include 'includes/auth.php';

?>

<h1>Créer un personnage</h1>
<form action="traitement_creation_personnage" method="POST" enctype="multipart/form-data">

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="classe">Classe :</label>
    <select id="classe" name="classe">
        <?php
        print_r($classes);
        foreach ($classes as $classe):
        ?>
            <option value="<?= htmlspecialchars($classe['CLA_ID']) ?>">
                <?= htmlspecialchars($classe['CLA_NAME']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="biographie">Biographie :</label>
    <textarea id="biographie" name="biographie"></textarea><br>

    <button type="submit">Créer</button>
</form>

<?php include 'includes/footer.php'; ?>