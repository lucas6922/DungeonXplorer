<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>
</head>

<body>
    <script>
        //passe les données du héros et du monstre au js.
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
        let monstre = [<?php echo json_encode($monster->getName()); ?>,
            <?php echo json_encode($monster->getHealth()); ?>,
            <?php echo json_encode($monster->getMana()); ?>,
            <?php echo json_encode($monster->getStrength()); ?>,
            <?php echo json_encode($monster->getInitiative()); ?>,
        ];
    </script>
    <?php include 'includes/header.php'; ?>
    <h1>Combat</h1>
    <div id="heros"></div>
    <div id="ennemi"></div>
    <button id="attaqueP">Attaque physique</button>
    <button id="attaqueM">Attaque magique</button>
    <button id="potion">Boire une potion</button>
    <div id="sorts"></div>
    <div id="console"> </div>
    <script src="<?php echo $baseUrl; ?>/JS/systemeCombat.js"></script>
    <?php include 'includes/footer.php'; ?>

    

</body>

</html>