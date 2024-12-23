<?php
class CompteController
{

    private $baseUrl = '/DungeonXplorer';

    public function form_create()
    {
        require_once 'views/creation_compte.php';
    }

    public function create($id)
    {
        $isAdmin = (bool)$id;

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
                if ($isAdmin) {
                    header(sprintf("Location: %s/pannel_admin/creation_compte_admin", $this->baseUrl));
                    exit();
                } else {
                    header(sprintf("Location: %s/creation_compte", $this->baseUrl));
                    exit();
                }
            }

            try {
                //vérifie unicite adresse mail
                $rqp = $connexion->prepare("SELECT 1 FROM PLAYER WHERE pla_mail = :email");
                $rqp->execute(['email' => $email]);
                if ($rqp->fetch()) {
                    $_SESSION['account_creation_error'] = "Un compte existe déjà avec cette adresse email";
                    if ($isAdmin) {
                        header(sprintf("Location: %s/pannel_admin/creation_compte_admin", $this->baseUrl));
                        exit();
                    } else {
                        header(sprintf("Location: %s/creation_compte", $this->baseUrl));
                        exit();
                    }
                }

                //vérifie unicite  pseudo
                $rqp = $connexion->prepare("SELECT 1 FROM PLAYER WHERE pla_pseudo = :pseudo");
                $rqp->execute(['pseudo' => $pseudo]);
                if ($rqp->fetch()) {
                    $_SESSION['account_creation_error'] = "Un compte existe déjà avec ce pseudo";
                    if ($isAdmin) {
                        header(sprintf("Location: %s/pannel_admin/creation_compte_admin", $this->baseUrl));
                        exit();
                    } else {
                        header(sprintf("Location: %s/creation_compte", $this->baseUrl));
                        exit();
                    };
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
                    INSERT INTO PLAYER (pla_id, PLA_FIRSTNAME, PLA_SURNAME, pla_mail, pla_pseudo, pla_passwd, isadmin)
                    VALUES (:id, :prenom, :nom, :email, :pseudo, :password, :isadmin)");
                $rqp->execute([
                    'id' => $id,
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'email' => $email,
                    'pseudo' => $pseudo,
                    'password' => $hashed,
                    'isadmin' => $isAdmin
                ]);

                //redirection vers la page d'accueil en etant connecte si creation compte réussi
                // Créer la session pour l'utilisateur et le connecter
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                session_regenerate_id(true);

                $_SESSION['is_admin'] = $isAdmin;
                $_SESSION['pla_id'] = $id;
                $_SESSION['pla_firstname'] = $prenom;
                $_SESSION['pla_surname'] = $nom;
                $_SESSION['pla_mail'] = $email;
                $_SESSION['pla_pseudo'] = $pseudo;


                if ($isAdmin) {
                    header(sprintf("Location: %s/pannel_admin/joueurs", $this->baseUrl));
                    exit();
                } else {
                    header(sprintf("Location: %s/", $this->baseUrl));
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['account_creation_error'] = "Une erreur est survenue lors de la création du compte : " . $e->getMessage();
                if ($isAdmin) {
                    header(sprintf("Location: %s/pannel_admin/creation_compte_admin", $this->baseUrl));
                    exit();
                } else {
                    header(sprintf("Location: %s/creation_compte", $this->baseUrl));
                    exit();
                }
            }
        } else {
            $_SESSION['account_creation_error'] = "Vous n'avez pas indiqué toutes vos informations";
            if ($isAdmin) {
                header(sprintf("Location: %s/pannel_admin/creation_compte_admin", $this->baseUrl));
                exit();
            } else {
                header(sprintf("Location: %s/creation_compte", $this->baseUrl));
                exit();
            }
        }

        $connexion = null;
    }





    public function form_login()
    {
        require_once 'views/form_connexion.php';
    }

    public function login()
    {
        require_once 'database/connexion_db.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $connexion = connect_db();

        $_SESSION = $_POST;

        $_SESSION['password'] = '';

        if (
            isset($_POST['pseudoOuEmail']) && isset($_POST['password']) &&
            !empty($_POST['pseudoOuEmail']) && !empty($_POST['password'])
        ) {

            $pseudoOuEmail = trim(strip_tags($_POST['pseudoOuEmail']));
            $password = trim($_POST['password']);

            if (!empty($pseudoOuEmail) && !empty($password)) {
                try {
                    // Vérifier que la paire (email, password) OU (pseudo, password)
                    // est présente dans la base de données

                    $select = $connexion->query("select pla_id, pla_firstname, pla_surname, pla_mail, pla_pseudo, pla_passwd, isadmin from PLAYER where pla_mail = '$pseudoOuEmail' or pla_pseudo = '$pseudoOuEmail'");
                    $enregistrement = $select->fetch(PDO::FETCH_OBJ);
                    if ($enregistrement) {
                        // Le compte existe
                        if (password_verify($password, $enregistrement->pla_passwd)) {
                            $_SESSION['is_admin'] = $enregistrement->isadmin;
                            $_SESSION['pla_id'] = $enregistrement->pla_id;
                            $_SESSION['pla_firstname'] = $enregistrement->pla_firstname;
                            $_SESSION['pla_surname'] = $enregistrement->pla_surname;
                            $_SESSION['pla_mail'] = $enregistrement->pla_mail;
                            $_SESSION['pla_pseudo'] = $enregistrement->pla_pseudo;
                            header('Location: ./');
                        } else {
                            $_SESSION['connexion_error'] = "Mot de passe incorrect";
                            header('Location: connexion');
                        }
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
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['pla_id'] = '';
        $_SESSION['pla_firstname'] = '';
        $_SESSION['pla_surname'] = '';
        $_SESSION['pla_mail'] = '';
        $_SESSION['pla_pseudo'] = '';

        header('Location: ./');
    }

    public function infos()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $prenom = isset($_SESSION['pla_firstname']) && !empty($_SESSION['pla_firstname']) ? $_SESSION['pla_firstname'] : '';
        $nom = isset($_SESSION['pla_surname']) && !empty($_SESSION['pla_surname']) ? $_SESSION['pla_surname'] : '';
        $pseudo = isset($_SESSION['pla_pseudo']) && !empty($_SESSION['pla_pseudo']) ? $_SESSION['pla_pseudo'] : '';
        $email = isset($_SESSION['pla_mail']) && !empty($_SESSION['pla_mail']) ? $_SESSION['pla_mail'] : '';

        require_once 'views/infos_compte.php';
    }

    public function delete()
    {
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
    }
}
