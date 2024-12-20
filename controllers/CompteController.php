<?php
class CompteController
{

    public function form_create()
    {
        require_once 'views/creation_compte.php';
    }

    public function create()
    {
        echo "ok";
        echo "<pre>";
        print_r($_POST);
        echo "<pre>";

        $connexion = connect_db();
        //verifie que tout est bien set
        if (
            isset($_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['email'], $_POST['password']) &&
            !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])
        ) {
            //enleve les espaces
            $nom = trim(strip_tags($_POST['nom']));
            $prenom = trim(strip_tags($_POST['prenom']));
            $pseudo = trim(strip_tags($_POST['pseudo']));
            $email = trim(strip_tags($_POST['email']));
            $password = trim($_POST['password']);

            //valide l'adresse mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['account_creation_error'] = "Cette adresse email n'est pas correcte";
                header('Location: creation_compte');
                exit();
            }

            try {
                //vérifie unicite adresse mail
                $rqp = $connexion->prepare("SELECT 1 FROM PLAYER WHERE pla_mail = :email");
                $rqp->execute(['email' => $email]);
                if ($rqp->fetch()) {
                    $_SESSION['account_creation_error'] = "Un compte existe déjà avec cette adresse email";
                    header('Location: creation_compte');
                    exit();
                }

                //vérifie unicite  pseudo
                $rqp = $connexion->prepare("SELECT 1 FROM PLAYER WHERE pla_pseudo = :pseudo");
                $rqp->execute(['pseudo' => $pseudo]);
                if ($rqp->fetch()) {
                    $_SESSION['account_creation_error'] = "Un compte existe déjà avec ce pseudo";
                    header('Location: creation_compte');
                    exit();
                }

                //hahsh mdp
                $hashed = password_hash($password, PASSWORD_DEFAULT);

                //recupère l'id max
                $rqp = $connexion->query("SELECT MAX(pla_id) AS maxi FROM PLAYER");
                $result = $rqp->fetch(PDO::FETCH_OBJ);
                //id + 1 pour le nouveau joueur
                $id = $result->maxi + 1;

                //insert le joueur
                $rqp = $connexion->prepare("
                    INSERT INTO PLAYER (pla_id, PLA_FIRSTNAME, PLA_SURNAME, pla_mail, pla_pseudo, pla_passwd)
                    VALUES (:id, :prenom, :nom, :email, :pseudo, :password)");
                $rqp->execute([
                    'id' => $id,
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'email' => $email,
                    'pseudo' => $pseudo,
                    'password' => $hashed
                ]);

                //redirection vers la page d'accueil en etant connecte si creation compte réussi
                // Créer la session pour l'utilisateur et le connecter
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                session_regenerate_id(true);

                $_SESSION['user_id'] = $id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_pseudo'] = $pseudo;
                $_SESSION['user_pseudo'] = $pseudo;
                header('Location: ./');
                exit();
            } catch (Exception $e) {
                $_SESSION['account_creation_error'] = "Une erreur est survenue lors de la création du compte : " . $e->getMessage();
                header('Location: creation_compte');
                exit();
            }
        } else {
            $_SESSION['account_creation_error'] = "Vous n'avez pas indiqué toutes vos informations";
            header('Location: creation_compte');
            exit();
        }

        $connexion = null;
    }





    public function form_login()
    {
        require_once 'views/form_connexion.php';
    }

    public function login()
    {
        require_once 'views/traitement_connexion.php';
    }

    public function logout()
    {
        require_once 'views/deconnexion.php';
    }

    public function infos()
    {
        require_once 'views/infos_compte.php';
    }

    public function delete()
    {
        require_once 'views/supprimer_compte.php';
    }
}
