<?php
session_start();

if (!isset($_SESSION['pla_id'])) {
    header('Location: connexion');
    exit();
}

$classes = Classe::getAll(); 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un personnage</title>
</head>
<body>
    <h1>Créer un personnage</h1>
    <form action="traitement_creation_personnage" method="POST" enctype="multipart/form-data">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="classe">Classe :</label>
    <select id="classe" name="classe" required>
        <?php foreach ($classes as $classe): ?>
            <option value="<?= htmlspecialchars($classe['CLA_ID']) ?>">
                <?= htmlspecialchars($classe['CLA_NAME']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="biographie">Biographie :</label>
    <textarea id="biographie" name="biographie" ></textarea><br>

    <button type="submit">Créer</button>
</form>

</body>
</html>
