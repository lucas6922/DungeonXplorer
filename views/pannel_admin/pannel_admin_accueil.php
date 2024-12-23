<?php include 'includes/header.php'; ?>
<h1>Panel Administrateur</h1>

<div class="admin-buttons">
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/joueurs">Gérer les joueurs</a></button>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/chapitres">Gérer les chapitres</a></button>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/monstres">Gérer les monstres</a></button>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/tresors">Gérer les trésors</a></button>
    <button><a href="<?php echo $baseUrl; ?>/pannel_admin/images">Gérer les images</a></button>
</div>
<?php include 'includes/footer.php'; ?>