<?php
    // create_account.php
    // traitement de la requête du formulaire pour créer le compte

    session_start();

    $_SESSION = $_POST;

    $_SESSION['password'] = '';

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) &&
        !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        
		$nom = trim(strip_tags($_POST['nom']));
		$prenom = trim(strip_tags($_POST['prenom']));
		$pseudo = trim(strip_tags($_POST['pseudo']));
		$email = trim(strip_tags($_POST['email']));

        // CHIFFRER LE MOT DE PASSE (bcrypt)
		$password = trim($_POST['password']);
		
		if (!empty($nom) && !empty($prenom) && !empty($pseudo) && !empty($email) && !empty($password)) {
			try {
                // Vérifier que le compte n'est pas déjà présent dans la db
                
                /*
                $select = $connexion->query("select * from accounts where email = $email");

                if ($enregistrement = $select->fetch(PDO::FETCH_OBJ)) {
                    $_SESSION['account_creation_error'] = "Un compte existe déjà avec cette adresse email";
                    header('Location: creation_compte');
                }
                
                $select = $connexion->query("select * from accounts where pseudo = $pseudo");

                if ($enregistrement = $select->fetch(PDO::FETCH_OBJ)) {
                    $_SESSION['account_creation_error'] = "Un compte existe déjà avec ce pseudo";
                    header('Location: creation_compte');
                }
                */

                $hashed = password_hash($password, PASSWORD_DEFAULT);

			    // Ajout du compte à la db
				// $connexion->exec("insert into accounts values (null, '$nom', '$pseudo', '$prenom', '$email', '$hashed')");

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