<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détail Personnage</title>
    </head>
    <body>
    <h1>Détail du personnage</h1>
    <ul>
    <?php foreach ($list as $list): ?>
        <li><?php echo $list; ?></li>
    <?php endforeach; ?>
    </ul>
    </body>
</html>