<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <h1>Combat</h1>
    <div id="heros"></div>
    <div id="ennemi"></div>
    <button id="attaqueP">Attaque physique</button>
    <button id="attaqueM">Attaque magique</button>
    <button id="potion">Boire une potion</button>
    <div id="sorts"></div>
    <div id="console"> </div>
    <?php include 'includes/footer.php'; ?>

    <!--passe les données du héros au js.-->
    <script>
        let personnage = [<?php echo json_encode($hero->getName()); ?>,
            <?php echo json_encode($hero->getClaId()); ?>,
            <?php echo json_encode($hero->getPV()); ?>,
            <?php echo json_encode($hero->getMana()); ?>,
            <?php echo json_encode($hero->getStrength()); ?>,
            <?php echo json_encode($hero->getInitiative()); ?>,
            <?php echo json_encode($hero->getArmor()); ?>,
            <?php echo json_encode($hero->getPrimWeapon()); ?>,
            <?php echo json_encode($hero->getSecWeapon()); ?>,
            <?php echo json_encode($hero->getShield()); ?>,
            <?php echo json_encode($hero->getSpellList()); ?>
        ];
    </script>

</body>

</html>