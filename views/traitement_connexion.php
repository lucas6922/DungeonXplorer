<?php
    // create_account.php
    // traitement de la requête du formulaire pour se connecter à un compte déjà existant

    require_once 'database/connexion_db.php';

    session_start();

    $connexion = connect_db();

    $_SESSION = $_POST;

    $_SESSION['password'] = '';

    if (isset($_POST['pseudoOuEmail']) && isset($_POST['password']) &&
        !empty($_POST['pseudoOuEmail']) && !empty($_POST['password'])) {
        
		$pseudoOuEmail = trim(strip_tags($_POST['pseudoOuEmail']));
		$password = trim($_POST['password']);
		
		if (!empty($pseudoOuEmail) && !empty($password)) {
			try {
                // Vérifier que la paire (email, password) OU (pseudo, password)
                // est présente dans la base de données
                
                $select = $connexion->query("select pla_id, pla_firstname, pla_surname, pla_mail, pla_pseudo, pla_passwd from PLAYER where pla_mail = '$pseudoOuEmail' or pla_pseudo = '$pseudoOuEmail'");
                $enregistrement = $select->fetch(PDO::FETCH_OBJ);

                if ($enregistrement && password_verify($password, $enregistrement->pla_passwd)) {
                    // Le compte existe
                    $_SESSION['user_id'] = $enregistrement->pla_id;
                    header('Location: ./');
                } else {
                    $_SESSION['connexion_error'] = "Ce compte n'existe pas";
                    header('Location: connexion');
                }
			} catch (Exception $e) {
                $_SESSION['connexion_error'] = "Une erreur est survenue lors de la connexion : " . $e->getMessage();
                header('Location: connexion');
			}
		} else {
            $_SESSION['connexion_error'] = "Les caractères < et > ne sont pas autorisés pour l'email";
            header('Location: connexion');
        }
	} else {
        $_SESSION['connexion_error'] = "Vous n'avez pas indiqué toutes vos informations";
        header('Location: connexion');
    }

    $connexion = null;
?>