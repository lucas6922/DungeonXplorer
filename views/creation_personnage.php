<?php
include 'includes/header.php';

?>

<h1>Créer un personnage</h1>
<form action="traitement_creation_personnage" method="POST" enctype="multipart/form-data">

    <label for="nom" class="form-txt">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="classe" class="form-txt">Classe :</label>
    <select id="classe" name="classe">
        <?php
        foreach ($classes as $classe):
        ?>
            <option value="<?= htmlspecialchars($classe['CLA_ID']) ?>">
                <?= htmlspecialchars($classe['CLA_NAME']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="biographie" class="form-txt">Biographie :</label>
    <textarea id="biographie" name="biographie"></textarea>

    <label for="image" class="form-txt">Image :</label>
    <input type="hidden" id="image" name="image">

    <!-- carousel issue de W3School -->
    <div class="slideshow-container">
        <?php

        foreach ($images as $index => $image) {
            $imageIndex = $index + 1;
        ?>
            <div class="mySlides fade">
                <img src="<?= $dir . '/' . $image ?>" style="width:100%">
            </div>
        <?php
        }
        ?>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
    </div>


    <button type="submit" class="form-btn">Créer</button>
</form>

<?php include 'includes/footer.php'; ?>