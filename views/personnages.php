<?php include 'includes/header.php'; ?>


<!-- code des cartes issue de W3Schools-->
<?php if (!empty($res)): ?>
    <div class="flip-card-container">
        <?php foreach ($res as $hero): ?>
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src=<?= $hero['HER_IMAGE'] ?> alt="Avatar">
                        <h1><?= $hero['HER_NAME'] ?></h1>
                    </div>
                    <div class="flip-card-back">

                        <?php if (!empty($hero['HER_BIOGRAPHY'])): ?>
                            <p>Biographie : <?= $hero['HER_BIOGRAPHY'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_PV'])): ?>
                            <p>Pv : <?= $hero['HER_PV'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['CLA_NAME'])): ?>
                            <p>Classe : <?= $hero['CLA_NAME'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_MANA'])): ?>
                            <p>Mana : <?= $hero['HER_MANA'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_STRENGTH'])): ?>
                            <p>Force : <?= $hero['HER_STRENGTH'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_INITIATIVE'])): ?>
                            <p>Initiative : <?= $hero['HER_INITIATIVE'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_ARMOR'])): ?>
                            <p>Armure : <?= $hero['HER_ARMOR'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_PRIM_WEAPON'])): ?>
                            <p>Première arme : <?= $hero['HER_PRIM_WEAPON'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_SEC_WEAPON'])): ?>
                            <p>Seconde arme : <?= $hero['HER_SEC_WEAPON'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_SHIELD'])): ?>
                            <p>Bouclier : <?= $hero['HER_SHIELD'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_XP'])): ?>
                            <p>XP : <?= $hero['HER_XP'] ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['HER_CURRENT_LEVEL'])): ?>
                            <p>Niveau : <?= $hero['HER_CURRENT_LEVEL'] ?></p>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Vous n'avez aucun personnage pour le moment.</p>
<?php endif; ?>



<?php include 'includes/footer.php'; ?>