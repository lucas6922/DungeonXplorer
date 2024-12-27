<?php
require_once 'database/connexion_db.php';
//---------------------------------------------------------------------------------------------------------//

//CONTROLLER GESTION CHAPITRES

//---------------------------------------------------------------------------------------------------------//

class ChapitresController
{

    private $baseUrl = '/DungeonXplorer';

    /**
     * affichage des chapitres
     */
    public function gererChapitres()
    {
        $chap = new AdmChapitre(connect_db());

        //recupère les chapitres
        $chapitres = $chap->getAllChap();
        require_once 'views/pannel_admin/chapitres.php';
    }

    /**
     * suppression d'un chapitre
     */
    public function supprimerChapitre()
    {
        $chap = new AdmChapitre(connect_db());

        //si formulaire envoyé avec l'id d'un chapitre pour le supp
        if (isset($_POST['cha_id'])) {

            $cha_id = $_POST['cha_id'];
            //supp le chapitre
            $chap->suppChap($cha_id);

            //recuper la nouvelle liste des chapitres
            $chap = $chap->getAllChap();
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
        exit();
    }

    /**
     * affichage du formulaire d'ajout d'un chapitre
     * récupère les loots pour les proposer à la creation
     */
    public function formAjoutChapitre()
    {
        $tresors = new Tresors(connect_db());
        $loots = $tresors->getLootIdName();

        require_once 'views/pannel_admin/creation_chapitre.php';
    }

    /**
     * traitement de l'ajout d'un chapitre
     */
    public function ajoutChapitre()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $chap = new AdmChapitre(connect_db());
        //verifie que tout est bien set
        if (
            isset($_POST['cha_name'], $_POST['cha_content']) &&
            !empty($_POST['cha_name']) && !empty($_POST['cha_content'])
        ) {
            $loo_id = isset($_POST['loo_id']) && !empty($_POST['loo_id']) ? intval($_POST['loo_id']) : null;
            $cha_name = trim(strip_tags($_POST['cha_name']));
            $cha_content = trim(strip_tags($_POST['cha_content']));
            $cha_image = trim(strip_tags($_POST['cha_image']));

            // print_r("loo: " . $loo_id . " name: " . $cha_name);
            // print_r(" cha_content: " . $cha_content . " cha_image: " . $cha_image);

            //vérifie unicite titre de chapitre

            if ($chap->isNotUniqueChap($cha_name)) {
                $_SESSION['chap_creation_error'] = "Un chapitre existe déjà avec ce titre";
                header(sprintf("Location: %s/pannel_admin/creation_chapitre", $this->baseUrl));
                exit();
            }

            //insert le chapitre
            try {
                $chap->insertChap($loo_id, $cha_name, $cha_content, $cha_image);
            } catch (Exception $e) {

                $_SESSION['chap_creation_error'] = "Erreur est survenu lors de l'insert : " . $e->getMessage();
                header(sprintf("Location: %s/pannel_admin/creation_chapitre", $this->baseUrl));
            }
        } else {
            $_SESSION['chap_creation_error'] = "le titre et la description du chapitre sont obligatoire";
            header(sprintf("Location: %s/pannel_admin/creation_chapitre", $this->baseUrl));
        }

        header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
    }

    /**
     * affichage du formulaire de modification d'un chapitre
     * avec champs preérempli
     */
    public function formModifChap()
    {
        if (!isset($_POST['cha_id']) || empty($_POST['cha_id'])) {
            $_SESSION['error_message'] = "Aucun chapitre spécifié.";
            header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
            exit();
        }

        $cha_id = intval($_POST['cha_id']);
        $chap = new AdmChapitre(connect_db());
        $tresors = new Tresors(connect_db());

        //recup données du chapitre
        try {
            //recupère les loots pour la selection
            $loots = $tresors->getLootIdName();

            //recupère les données du chapitre (avec celle du loot associé)
            $chapitre = $chap->getChap($cha_id);

            if (!$chapitre) {
                $_SESSION['error_message'] = "Chapitre introuvable.";
                header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
                exit();
            }
            //affiche le formulaire de modification
            require_once 'views/pannel_admin/modifier_chapitre.php';
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Erreur lors de la récupération du chapitre : " . $e->getMessage();
            header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
            exit();
        }
        $connexion = null;
    }

    /**
     * traitement de la mise à jour d'un chapitre
     */
    public function ModifChap()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            isset($_POST['cha_id'], $_POST['cha_name'], $_POST['cha_content']) &&
            !empty($_POST['cha_id']) && !empty($_POST['cha_name']) && !empty($_POST['cha_content'])
        ) {

            $cha_id = intval($_POST['cha_id']);
            $cha_name = trim(strip_tags($_POST['cha_name']));
            $cha_content = trim(strip_tags($_POST['cha_content']));
            $cha_image = trim(strip_tags($_POST['cha_image']));


            $chap = new AdmChapitre(connect_db());

            //mise à jour du chapitre
            try {
                $chap->updateChap($cha_name, $cha_content, $cha_id, $cha_image);
            } catch (Exception $e) {
                $_SESSION['chap_creation_error'] = "Erreur lors de la modification : " . $e->getMessage();
                header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
            }
        } else {
            $_SESSION['chap_creation_error'] = "le titre et la description du chapitre sont obligatoire";
            header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
        }
        header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
        $connexion = null;
    }
}
