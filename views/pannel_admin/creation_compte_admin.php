<?php include 'includes/header.php'; ?>

<h1>Création de compte</h1>

<form action="<?php echo $baseUrl; ?>/traitement_creation_compte/1" method="POST" enctype="multipart/form-data">


    <label for="nom">Votre nom</label>

    <input type="text" name="nom" size="17" placeholder="Saisissez votre nom" required>

    <label for="prenom">Votre prénom</label>

    <input type="text" name="prenom" size="17" placeholder="Saisissez votre prénom" required>


    <label for="pseudo">Votre pseudo</label>

    <input type="text" name="pseudo" size="17" placeholder="Saisissez votre pseudo" required>


    <label for="email">Votre email</label>

    <input type="email" name="email" size="30" placeholder="Saisissez votre adresse email" required>


    <label for="password">Votre mot de passe</label>

    <input type="password" name="password" size="30" placeholder="Saisissez votre mot de passe" required>


    <button type="submit" class="form-btn">Valider</button>
</form>

<?php
if (isset($_SESSION['account_creation_error']) || !empty($_SESSION['account_creation_error'])) :
?>

    <script>
        afficherErreur("<?= htmlspecialchars($_SESSION['account_creation_error'], ENT_QUOTES) ?>");
    </script>
<?php
    unset($_SESSION['account_creation_error']);
endif;
?>

<?php include 'includes/footer.php'; ?>