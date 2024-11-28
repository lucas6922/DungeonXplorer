<?php
    // creation_personnage_error.php
    // traitement de la requête du formulaire pour créer un personnage

    session_start();

    $_SESSION = $_POST;

    if (isset($_POST['name']) && isset($_POST['image']) && isset($_POST['classe'])  &&
        !empty($_POST['name']) && !empty($_POST['image']) && !empty($_POST['classe'])) {
        
		$name = trim(strip_tags($_POST['name']));
		$image = trim(strip_tags($_POST['image']));
		$classe = trim(strip_tags($_POST['classe']));
		
		if (!empty($name) && !empty($image) && !empty($classe)) {
			// Ajout du compte à la db

			try {
				// $connexion->exec("insert into accounts values (null, '$name', '$image', '$classe')");

                header('Location: index');
			} catch (Exception $e) {
                $_SESSION['account_creation_error'] = "Une erreur est survenue lors de la création du personnage : " . $e->getMessage();
                header('Location: creation_personnage');
			}
		} else {
            $_SESSION['account_creation_error'] = "Les caractères < et > ne sont pas autorisés";
            header('Location: creation_personnage');
        }
	} else {
        $_SESSION['account_creation_error'] = "Vous n'avez pas indiqué toutes vos informations";
        header('Location: creation_personnage');
    }

    
?>