<?php
    // create_account.php
    // traitement de la requête du formulaire pour créer le compte

    // faire les redirections en javascript

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password']) &&
        !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        
		$nom = trim(strip_tags($_POST['nom']));
		$prenom = trim(strip_tags($_POST['prenom']));
		$email = trim(strip_tags($_POST['email']));
		$password = trim(strip_tags($_POST['password']));
		
		if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($password)) {
			// Ajout du compte à la db

			try {
				// $connexion->exec("insert into accounts values (null, '$nom', '$prenom', '$email', '$password')");
                echo 'Compte créé !';

                // sleep(5);
                // header('Location: index.php');
			} catch (Exception $e) {
				echo "Une erreur est survenue lors de l'insertion : ", $e->getMessage();
                // sleep(5);
			}
		} else {
            header('Location: form_account_creation.php');
        }
	} else {
        header('Location: form_account_creation.php');
    }

    
?>