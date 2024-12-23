<?php include 'includes/header.php'; ?>

<h1><?php echo $chapter->getTitle(); ?></h1>
<img src="<?php echo $chapter->getImage(); ?>" alt="Image de chapitre">
<p><?php echo $chapter->getDescription(); ?></p>

<h2>Choisissez votre chemin:</h2>
<ul>
    <?php foreach ($next as $nextChapId => $liContent):
        /*
        print_r($next);
        print_r($nextChapId);
        print_r($liContent);
        */
    ?>
        <li>
            <a href="chapitre/<?php echo $nextChapId; ?>">
                <?php echo $liContent; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>