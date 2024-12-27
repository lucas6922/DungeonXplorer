<?php
require_once 'database/connexion_db.php';
class MonstresController
{

    private $baseUrl = '/DungeonXplorer';

    /**
     * affiche tous les monstres
     */
    public function gererMonstres()
    {
        $modMonstre = new AdmMonstre(connect_db());

        $monsters = $modMonstre->getAllMonstres();
        require_once 'views/pannel_admin/monstres.php';
    }

    /**
     * logique de suppression d'un monstre
     */
    public function supprimerMonstre()
    {
        $modMonstre = new AdmMonstre(connect_db());

        //si formulaire envoyé avec l'id d'un monstre pour le supp
        if (isset($_POST['mon_id'])) {
            $mon_id = $_POST['mon_id'];

            //supp le joueur
            $modMonstre->suppMonstre($mon_id);

            //recuper la nouvelle liste des monstres
            $monstres = $modMonstre->getAllMonstres();
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
        exit();
    }

    /**
     * affichage du formulaire d'ajout d'un monstre
     * récupère les loots de la bdd pour les proposer
     */
    public function formAjoutMonstre()
    {
        $tresors = new Tresors(connect_db());

        $loots = $tresors->getLootIdName();

        require_once 'views/pannel_admin/creation_monstre.php';
    }

    /**
     * traitement de l'ajout d'un monstre
     */
    public function ajoutMonstre()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        if (
            isset($_POST['loo_id'], $_POST['mon_name'], $_POST['mon_pv'], $_POST['mon_initiative'], $_POST['mon_strength'], $_POST['mon_xp']) &&
            !empty($_POST['mon_name']) && !empty($_POST['mon_pv']) && !empty($_POST['loo_id'])
            && !empty($_POST['mon_initiative']) && !empty($_POST['mon_strength'] && !empty($_POST['mon_xp']))
        ) {
            $loo_id = intval($_POST['loo_id']);
            $mon_name = trim(strip_tags($_POST['mon_name']));
            $mon_pv = intval($_POST['mon_pv']);
            $mon_mana = isset($_POST['mon_mana']) ? intval($_POST['mon_mana']) : null;
            $mon_initiative = intval($_POST['mon_initiative']);
            $mon_strength = intval($_POST['mon_strength']);
            $mon_attack = isset($_POST['mon_attack']) ? trim(strip_tags($_POST['mon_attack'])) : null;
            $mon_xp = isset($_POST['mon_xp']) ? intval($_POST['mon_xp']) : null;

            $modMonstre = new AdmMonstre(connect_db());

            try {
                //unicite d'un monstre
                if ($modMonstre->isNotUniqueMonst($mon_name)) {
                    //existe deja
                    $_SESSION['mon_creation_error'] = "Un monstre existe déjà avec ce nom.";
                    header("Location: " . $this->baseUrl . "/pannel_admin/creation_monstre");
                    exit();
                }

                $modMonstre->insertMonstre($loo_id, $mon_name, $mon_pv, $mon_mana, $mon_initiative, $mon_strength, $mon_attack, $mon_xp);
                header("Location: " . $this->baseUrl . "/pannel_admin/monstres");
                exit();
            } catch (Exception $e) {
                //erreur pendant l'insertion
                $_SESSION['mon_creation_error'] = "Une erreur est survenue lors de l'insertion : " . $e->getMessage();
                header("Location: " . $this->baseUrl . "/pannel_admin/creation_monstre");
                exit();
            }
        } else {
            //rous les champs ne sont pas renseigné
            $_SESSION['mon_creation_error'] = "Le nom, les points de vie, l'initiative, la force et l'xp du monstre sont obligatoires.";
            header("Location: " . $this->baseUrl . "/pannel_admin/creation_monstre");
            exit();
        }
    }


    /**
     * affichage du formulaire de modification d'un monstre
     * champs prérempli avec les données du monstre
     */
    public function formModifierMonstre()
    {

        if (!isset($_POST['mon_id']) || empty($_POST['mon_id'])) {
            $_SESSION['error_message'] = "Aucun monstre spécifié.";
            header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
            exit();
        }

        $mon_id = intval($_POST['mon_id']);
        $modMonstre = new AdmMonstre(connect_db());
        $tresors = new Tresors(connect_db());

        //recup données du monstre
        try {

            //récupère tous les loots pour les proposer
            $loots = $tresors->getLootIdName();
            //récupère les données du monstre à modifier
            $monstre = $modMonstre->getMonstre($mon_id);
            if (!$monstre) {
                $_SESSION['error_message'] = "Monstre introuvable.";
                header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
                exit();
            }
            //affiche le formulaire de modification
            require_once 'views/pannel_admin/modifier_monstre.php';
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Erreur lors de la récupération du monstre : " . $e->getMessage();
            header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
            exit();
        }
        require_once 'views/pannel_admin/modifier_monstre.php';
    }

    /**
     * traitement de la mise à jour d'un monstre
     */
    public function modifierMonstre()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //verifie les champs
        if (
            isset($_POST['loo_id'], $_POST['mon_id'], $_POST['mon_name'], $_POST['mon_pv'], $_POST['mon_initiative'], $_POST['mon_strength']) &&
            !empty($_POST['loo_id']) && !empty($_POST['mon_id']) && !empty($_POST['mon_name']) && !empty($_POST['mon_pv']) && !empty($_POST['mon_initiative']) && !empty($_POST['mon_strength'])
        ) {
            $loo_id = intval($_POST['loo_id']);
            $mon_id = intval($_POST['mon_id']);
            $mon_name = trim(strip_tags($_POST['mon_name']));
            $mon_pv = intval($_POST['mon_pv']);
            $mon_mana = isset($_POST['mon_mana']) ? intval($_POST['mon_mana']) : null;
            $mon_initiative = intval($_POST['mon_initiative']);
            $mon_strength = intval($_POST['mon_strength']);
            $mon_attack = isset($_POST['mon_attack']) ? trim(strip_tags($_POST['mon_attack'])) : null;
            $mon_xp = isset($_POST['mon_xp']) ? intval($_POST['mon_xp']) : null;

            $modMonstre = new AdmMonstre(connect_db());

            //mise à jour du monstre
            try {
                $modMonstre->updateMonstre($mon_name, $mon_pv, $mon_mana, $mon_initiative, $mon_strength, $mon_attack, $mon_xp, $mon_id, $loo_id);
            } catch (Exception $e) {
                $_SESSION['mon_creation_error'] = "Erreur lors de la modification du monstre : " . $e->getMessage();
                header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
                exit();
            }
        } else {
            $_SESSION['mon_creation_error'] = "Tous les champs obligatoires sont requis.";
            header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
            exit();
        }      //redirige vers la page des monstres apres update
        header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
        $connexion = null;
    }
}
