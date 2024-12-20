<?php include 'includes/header.php'; ?>

<h1>Création de compte</h1>

<form action="traitement_creation_compte" method="POST" enctype="multipart/form-data">


    <label for="nom">Votre nom</label>
    <br>
    <input type="text" name="nom" size="17" placeholder="Saisissez votre nom" required>
    <br>
    <label for="prenom">Votre prénom</label>
    <br>
    <input type="text" name="prenom" size="17" placeholder="Saisissez votre prénom" required>
    <br><br>

    <label for="pseudo">Votre pseudo</label>
    <br>
    <input type="text" name="pseudo" size="17" placeholder="Saisissez votre pseudo" required>
    <br><br>

    <label for="email">Votre email</label>
    <br>
    <input type="email" name="email" size="30" placeholder="Saisissez votre adresse email" required>
    <br><br>

    <label for="password">Votre mot de passe</label>
    <br>
    <input type="password" name="password" size="30" placeholder="Saisissez votre mot de passe" required>
    <br><br>

    <button type="submit">Valider</button>
</form>

<?php
if (isset($_SESSION['account_creation_error']) || !empty($_SESSION['account_creation_error'])) {
    echo '<p style="color:red;">' . htmlspecialchars($_SESSION['account_creation_error']) . '</p>';
    unset($_SESSION['account_creation_error']);
}
?>

<?php include 'includes/footer.php'; ?>