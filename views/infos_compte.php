<?php include 'includes/header.php' ?>
<h1>Informations du compte</h1>

<div class="info-compte">
    <p>Prénom : <?= $prenom ?></p>
    <p>Nom : <?= $nom ?></p>
    <p>Pseudo : <?= $pseudo ?></p>
    <p>Adresse email : <?= $email ?></p>
</div>


<form action="supprimer_compte" method="POST" id="form-info-compte" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
    <button type="submit" class="btn-supp">Supprimer le compte</button>
</form>

<?php include 'includes/footer.php' ?>