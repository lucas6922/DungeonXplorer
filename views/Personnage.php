<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personnages</title>
    </head>
    <body>
    <h1>Liste des personnages</h1>
    <ul>
    <?php foreach ($list as $list): ?>
        <li><?php echo $list; ?></li>
    <?php endforeach; ?>
    </ul>
    </body>
</html>