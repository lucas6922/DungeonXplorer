<?php include 'includes/header.php' ?>
<h1>Informations du compte</h1>
<?php
echo 'Prénom : ' . $prenom;
echo '<br>';
echo 'Nom : ' . $nom;
echo '<br>';
echo 'Pseudo : ' . $pseudo;
echo '<br>';
echo 'Adresse email : ' . $email;
?>
<br>
<br>
<button><a href="supprimer_compte">Supprimer le compte</a></button>

<?php include 'includes/footer.php' ?>