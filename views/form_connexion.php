<?php
include 'includes/header.php'
?>

<h1>Connexion</h1>

<form action="traitement_connexion" method="POST">
    <label for="pseudoOuEmail">Votre pseudo ou adresse email</label>
    <br>
    <input type="text" name="pseudoOuEmail" size="30" placeholder="Saisissez votre pseudo / email"
        value="<?= htmlspecialchars($_SESSION['pseudoOuEmail'] ?? '') ?>"> <br><br>

    <label for="password">Votre mot de passe</label>
    <br>
    <input type="password" name="password" size="30" placeholder="Saisissez votre mot de passe">
    <br><br>

    <button type="submit">Se connecter</button>

    <?php if (!empty($_SESSION['connexion_error'])) : ?>
        <p style="color:red;"><?= htmlspecialchars($_SESSION['connexion_error']) ?></p>
    <?php endif; ?>
</form>

<br>
<br>

<?php
include 'includes/footer.php'
?>