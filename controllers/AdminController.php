<?php
require_once 'database/connexion_db.php';
class AdminController
{

    private $baseUrl = '/DungeonXplorer';

    public function showPannelAdmin()
    {
        require_once 'views/pannel_admin/pannel_admin_accueil.php';
    }

    public function gererJoueurs()
    {
        $connexion = connect_db();

        $select = $connexion->query("SELECT * FROM PLAYER");
        $joueurs = $select->fetchAll(PDO::FETCH_ASSOC);
        if (!$joueurs) {
            $joueurs = [];  //si aucun joueur trouvé
        }

        require_once 'views/pannel_admin/joueurs.php';
        $connexion = null;
    }

    public function supprimerJoueur()
    {
        $connexion = connect_db();

        //si formulaire envoyé avec l'id d'un joueur pour le supp
        if (isset($_POST['pla_id'])) {

            $pla_id = $_POST['pla_id'];
            //supp le joueur
            $rqp = $connexion->prepare("DELETE FROM PLAYER WHERE PLA_ID = ?");
            $rqp->execute([$pla_id]);

            //reuper la nouvelle liste des joueurs
            $select = $connexion->query("SELECT * FROM PLAYER");
            $joueurs = $select->fetchAll(PDO::FETCH_ASSOC);
            if (!$joueurs) {
                $joueurs = [];  //si aucun joueur trouvé
            }

            require_once 'views/pannel_admin/joueurs.php';
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        $connexion = null;
    }

    //inutile car ajout avec la m^me méthode que l'ajout d'un cmpte normal
    /*
    public function sajoutCompteAdmin()
    {
        require_once 'views/pannel_admin/cration_compte_admin.php';
    }*/


    public function gererChapitres()
    {
        $connexion = connect_db();

        $select = $connexion->query("SELECT * FROM CHAPTER");
        $chapitres = $select->fetchAll(PDO::FETCH_ASSOC);
        if (!$chapitres) {
            $chapitres = [];  //si aucun joueur trouvé
        }
        require_once 'views/pannel_admin/chapitres.php';
        $connexion = null;
    }

    public function supprimerChapitre()
    {
        $connexion = connect_db();

        //si formulaire envoyé avec l'id d'un chapitre pour le supp
        if (isset($_POST['cha_id'])) {

            $cha_id = $_POST['cha_id'];
            //supp le joueur
            $rqp = $connexion->prepare("DELETE FROM CHAPTER WHERE CHA_ID = ?");
            $rqp->execute([$cha_id]);

            //reuper la nouvelle liste des chapitres
            $select = $connexion->query("SELECT * FROM CHAPTER");
            $chapitres = $select->fetchAll(PDO::FETCH_ASSOC);
            if (!$chapitres) {
                $chapitres = [];  //si aucun joueur trouvé
            }

            require_once 'views/pannel_admin/chapitres.php';
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        $connexion = null;
    }

    public function formAjoutChapitre()
    {
        require_once 'views/pannel_admin/form_creation_chapitre.php';
    }

    public function ajoutChapitre()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $connexion = connect_db();
        //verifie que tout est bien set
        if (
            isset($_POST['cha_name'], $_POST['cha_content']) &&
            !empty($_POST['cha_name']) && !empty($_POST['cha_content'])
        ) {
            $loo_id = isset($_POST['loo_id']) && !empty($_POST['loo_id']) ? intval($_POST['loo_id']) : null;
            $cha_name = trim(strip_tags($_POST['cha_name']));
            $cha_content = trim(strip_tags($_POST['cha_content']));
            $cha_image = trim(strip_tags($_POST['cha_image']));

            print_r("loo: " . $loo_id . " name: " . $cha_name);
            print_r(" cha_content: " . $cha_content . " cha_image: " . $cha_image);

            //vérifie unicite titre de chapitre
            $rqp = $connexion->prepare("SELECT 1 FROM CHAPTER WHERE cha_name = :nom");
            $rqp->execute(['nom' => $cha_name]);
            if ($rqp->fetch()) {
                $_SESSION['chap_creation_error'] = "Un chapitre existe déjà avec ce titre";
                header(sprintf("Location: %s/pannel_admin/creation_chapitre_admin", $this->baseUrl));
                exit();
            }

            //insert le chapitre
            try {

                $rqp = $connexion->prepare("
                INSERT INTO CHAPTER (LOO_ID, CHA_NAME, CHA_CONTENT, CHA_IMAGE)
                VALUES (:loot, :titre, :content, :image)
            ");
                $rqp->execute([
                    'loot' => $loo_id,
                    'titre' => $cha_name,
                    'content' => $cha_content,
                    'image' => $cha_image,
                ]);
            } catch (Exception $e) {

                $_SESSION['chap_creation_error'] = "Erreur est survenu lors de l'insert : " . $e->getMessage();
                header(sprintf("Location: %s/pannel_admin/creation_chapitre_admin", $this->baseUrl));
            }
        }

        header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
    }

    public function gererMonstres()
    {
        require_once 'views/pannel_admin/monstres.php';
    }

    public function gererTresors()
    {
        require_once 'views/pannel_admin/tresors.php';
    }

    public function gererImages()
    {
        require_once 'views/pannel_admin/images.php';
    }
}
