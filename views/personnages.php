<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personnages</title>
    </head>
    <?php if (!empty($heros)): ?>
        <pre>
        <?php ($heros) ?>
        </pre>
        <ul>
            <?php foreach ($heros as $hero): ?>
                <li>
                    <strong>Nom :</strong> <?= htmlspecialchars($hero['HER_NAME']) ?><br>
                    <strong>Classe :</strong> <?= htmlspecialchars($hero['CLA_ID']) ?><br>
                    <strong>Biographie :</strong> <?= htmlspecialchars($hero['HER_BIOGRAPHY']) ?><br>
                    <strong>Image :</strong> 
                    <?php if (!empty($hero['HER_IMAGE'])): ?>
                        <img src="<?= htmlspecialchars($hero['HER_IMAGE']) ?>" alt="<?= htmlspecialchars($hero['HER_NAME']) ?>" width="100">
                    <?php else: ?>
                        Pas d'image disponible
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Vous n'avez aucun personnage pour le moment.</p>
    <?php endif; ?>
</html>