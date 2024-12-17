<?php
    // deconnexion.php
    // pour se déconnecter d'un compte

    session_start();

    $_SESSION['pla_id'] = '';
    $_SESSION['pla_firstname'] = '';
    $_SESSION['pla_surname'] = '';
    $_SESSION['pla_mail'] = '';
    $_SESSION['pla_pseudo'] = '';

    header('Location: ./');
?>