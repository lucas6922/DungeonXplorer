<?php include 'includes/header.php' ?>
<h1>Connexion</h1>

<form action="traitement_connexion" method="POST">
    <label for="pseudoOuEmail">Votre pseudo ou adresse email</label>

    <input type="text" name="pseudoOuEmail" size="30" placeholder="Saisissez votre pseudo / email"
        value="<?= htmlspecialchars($_SESSION['pseudoOuEmail'] ?? '') ?>">

    <label for="password">Votre mot de passe</label>

    <input type="password" name="password" size="30" placeholder="Saisissez votre mot de passe">


    <button type="submit" class="form-btn">Se connecter</button>


</form>
<?php
//si erreur stocké dans session
if (isset($_SESSION['connexion_error']) || !empty($_SESSION['connexion_error'])) :
    //print_r($_SESSION['connexion_error']);
?>
    <script>
        afficherErreur("<?= $_SESSION['connexion_error'] ?>");
    </script>
<?php
    unset($_SESSION['connexion_error']);
endif;
?>

<?php include 'includes/footer.php' ?>