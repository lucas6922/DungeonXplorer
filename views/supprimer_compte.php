<?php
    // supprimer_compte.php
    // supprime le compte sur lequel vous êtes connecté

    require_once 'database/connexion_db.php';

    session_start();

    $_SESSION['pla_firstname'] = '';
    $_SESSION['pla_surname'] = '';
    $_SESSION['pla_mail'] = '';
    $_SESSION['pla_pseudo'] = '';

    if (isset($_SESSION['pla_id']) && !empty($_SESSION['pla_id'])) {
        $pla_id = $_SESSION['pla_id'];

        $connexion = connect_db();
        $connexion->exec("delete from PLAYER where pla_id = $pla_id");

        $_SESSION['pla_id'] = '';
        $connexion = null;
        header('Location: ./');
    } else {
        $_SESSION['pla_id'] = '';
        header('Location: ./');
    }
?>