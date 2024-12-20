<?php include 'includes/header.php'; ?>

<h1><?php echo $chapter->getTitle(); ?></h1>
<img src="<?php echo $chapter->getImage(); ?>" alt="Image de chapitre" style="max-width: 100%; height: auto;">
<p><?php echo $chapter->getDescription(); ?></p>

<h2>Choisissez votre chemin:</h2>
<ul>
    <?php foreach ($chapter->getChoices() as $choice): ?>
        <li>
            <a href="<?php echo $choice['chapter']; ?>">
                <?php echo $choice['text']; ?>
            </a>
        </li>
    <?php endforeach; ?> 
</ul>

<?php include 'includes/footer.php'; ?>
