<?php
    // create_account.php
    // traitement de la requête du formulaire pour créer le compte

    session_start();

    $_SESSION = $_POST;

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) &&
        !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        
		$nom = trim(strip_tags($_POST['nom']));
		$prenom = trim(strip_tags($_POST['prenom']));
		$pseudo = trim(strip_tags($_POST['pseudo']));
		$email = trim(strip_tags($_POST['email']));
		$password = trim(strip_tags($_POST['password'])); // retirer le strip_tags pour le mdp ?
		
		if (!empty($nom) && !empty($prenom) && !empty($pseudo) && !empty($email) && !empty($password)) {
			// Ajout du compte à la db

			try {
				// $connexion->exec("insert into accounts values (null, '$nom', '$pseudo', '$prenom', '$email', '$password')");

                header('Location: index');
			} catch (Exception $e) {
                $_SESSION['account_creation_error'] = "Une erreur est survenue lors de la création du compte : " . $e->getMessage();
                header('Location: creation_compte');
			}
		} else {
            $_SESSION['account_creation_error'] = "Les caractères < et > ne sont pas autorisés";
            header('Location: creation_compte');
        }
	} else {
        $_SESSION['account_creation_error'] = "Vous n'avez pas indiqué toutes vos informations";
        header('Location: creation_compte');
    }

    
?>