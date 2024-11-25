<?php
    // create_account.php
    // traitement de la requête du formulaire pour se connecter à un compte déjà existant

    session_start();

    $_SESSION = $_POST;

    $_SESSION['password'] = '';

    if (isset($_POST['pseudoOuEmail']) && isset($_POST['password']) &&
        !empty($_POST['pseudoOuEmail']) && !empty($_POST['password'])) {
        
		$pseudoOuEmail = trim(strip_tags($_POST['pseudoOuEmail']));

        // CHIFFRER LE MOT DE PASSE (bcrypt)
        // (pour le comparer avec le mot de passe chiffré dans la base)
		$password = trim($_POST['password']);
		
		if (!empty($pseudoOuEmail) && !empty($password)) {
			try {
                // Vérifier que la paire (email, password) OU (pseudo, password)
                // est présente dans la base de données
                /*
                $select = $connexion->query("select * from accounts where password = $password and (email = $pseudoOuEmail or pseudo = $pseudoOuEmail)");

                if ($enregistrement = $select->fetch(PDO::FETCH_OBJ)) {
                    $_SESSION['user_id'] = $enregistrement['id'];
                    header('Location: index');
                } else {
                    $_SESSION['connexion_error'] = "Ce compte n'existe pas";
                    header('Location: connexion');
                }
                */
                header('Location: index');
			} catch (Exception $e) {
                $_SESSION['connexion_error'] = "Une erreur est survenue lors de la création du compte : " . $e->getMessage();
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

    
?>