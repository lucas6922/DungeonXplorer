<?php
require_once 'database/connexion_db.php';
class TresorsController
{

    private $baseUrl = '/DungeonXplorer';



    //---------------------------------------------------------------------------------------------------------//

    //TRESORS

    //---------------------------------------------------------------------------------------------------------//

    /**
     * affiche les tresors(items et loots)
     */
    public function gererTresors()
    {
        $connexion = connect_db();

        $Tresors = new Tresors($connexion);

        //récupère les items
        $items = $Tresors->getAllItems();
        //récupère les loots
        $loots = $Tresors->transformLoot($Tresors->getAllLoots());

        require_once 'views/pannel_admin/tresors.php';
        $connexion = null;
    }

    /**
     * affiche le formualire de l'ajout d'item
     */
    public function formAjoutItem()
    {
        //récupère les types d'item
        $tresors = new Tresors(connect_db());
        $types = $tresors->getAllTypes();

        require_once 'views/pannel_admin/creation_item.php';
        $connexion = null;
    }

    /**
     * traitement de l'ajout d'un item
     */
    public function ajoutItem()
    { {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $tresors = new Tresors(connect_db());

            if (
                isset($_POST['ite_name']) && !empty($_POST['ite_name'])
            ) {
                $ite_name = trim(strip_tags($_POST['ite_name']));
                $ite_description = isset($_POST['ite_poids']) ?  trim(strip_tags($_POST['ite_description'])) : null;
                $ite_poids = isset($_POST['ite_poids']) ? intval($_POST['ite_poids']) : null;
                $typ_id = isset($_POST['typ_id']) ? intval($_POST['typ_id']) : null;
                $ite_value = isset($_POST['ite_value']) ? intval($_POST['ite_value']) : null;

                try {
                    if ($tresors->isNotUniqueItem($ite_name)) {
                        //existe deja
                        $_SESSION['error_message'] = "Un item existe déjà avec ce nom.";
                        header("Location: " . $this->baseUrl . "/pannel_admin/creation_item");
                        exit();
                    }

                    //insertion de l'item
                    $tresors->insertItem($ite_name, $ite_description, $ite_poids, $typ_id, $ite_value);

                    header("Location: " . $this->baseUrl . "/pannel_admin/tresors");
                    exit();
                } catch (Exception $e) {
                    //erreur pendant l'insertion
                    $_SESSION['error_message'] = "Une erreur est survenue lors de l'insertion : " . $e->getMessage();
                    header("Location: " . $this->baseUrl . "/pannel_admin/creation_item");
                    exit();
                }
            } else {
                //rous les champs ne sont pas renseigné
                $_SESSION['error_message'] = "Le nom de l'item esy obligatoire.";
                header("Location: " . $this->baseUrl . "/pannel_admin/creation_item");
                exit();
            }
            $connexion = null;
        }
    }

    /**
     * suppression d'un item
     */
    public function supprimerItem()
    {
        $tresors = new Tresors(connect_db());

        //si formulaire envoyé avec l'id d'un item pour le supp
        if (isset($_POST['ite_id'])) {

            $ite_id = $_POST['ite_id'];
            //supp l'item
            $tresors->suppItem($ite_id);

            //recupere la nouvelle liste des items
            $items = $tresors->getAllItems();

            header("Location: " . $this->baseUrl . "/pannel_admin/tresors");
            exit();
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        $connexion = null;
    }

    /**
     * affichage du formulaire de modification d'un item
     * récupère les donnes relative à l'item pour prérenmplir les champs
     */
    public function formModifierItem()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_POST['ite_id']) || empty($_POST['ite_id'])) {
            $_SESSION['error_message'] = "Aucun item spécifié.";
            header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
            exit();
        }

        $ite_id = intval($_POST['ite_id']);
        $connexion = connect_db();
        $tresors = new Tresors(connect_db());

        try {
            //récupere tous les types d'item
            $types = $tresors->getAllTypes();
            //valeurs de l'item
            $item = $tresors->getItem($ite_id);

            if (!$item) {
                $_SESSION['error_message'] = "Item introuvable.";
                header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
                exit();
            }
            //affiche le formulaire de modification
            require_once 'views/pannel_admin/modifier_item.php';
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Erreur lors de la récupération de l'item : " . $e->getMessage();
            header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
            exit();
        }
        $connexion = null;
    }

    /**
     * traitement de la modification d'un item
     */
    public function modifierItem()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //verifie les champs
        if (
            isset($_POST['ite_name'], $_POST['ite_id']) && !empty($_POST['ite_name']) && !empty($_POST['ite_id'])
        ) {

            $ite_id = intval($_POST['ite_id']);
            $ite_name = trim(strip_tags($_POST['ite_name']));
            $ite_description = trim(strip_tags($_POST['ite_description']));
            $ite_poids = isset($_POST['ite_poids']) ? intval($_POST['ite_poids']) : null;
            $ite_value = isset($_POST['ite_value']) ? intval($_POST['ite_value']) : null;
            $typ_id = isset($_POST['typ_id']) ? intval($_POST['typ_id']) : null;

            $tresors = new Tresors(connect_db());

            //mise à jour de l'item
            try {
                $tresors->updateItem($ite_name, $ite_description, $ite_poids, $ite_value, $typ_id, $ite_id);
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Erreur lors de la modification de l'item : " . $e->getMessage();
                header(sprintf("Location: %s/pannel_admin/tresors/modifier_item", $this->baseUrl));
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Tous les champs obligatoires sont requis.";
            header(sprintf("Location: %s/pannel_admin/tresors/modifier_item", $this->baseUrl));
            exit();
        }
        //redirige vers la page des tresors apres update
        header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
        $connexion = null;
    }

    /**
     * affichage du formulaire d'ajout d'un loot
     */
    public function formAjoutLoot()
    {
        $tresors = new Tresors(connect_db());
        $items = $tresors->getAllItems();
        require_once 'views/pannel_admin/creation_loot.php';
    }

    /**
     * traitement de l'ajout d'un loot
     */
    public function ajoutLoot()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $tresors = new Tresors(connect_db());

        if (
            isset($_POST['loo_name']) && !empty($_POST['loo_name'])
        ) {
            $loo_name = trim(strip_tags($_POST['loo_name']));
            //a voir si on laisse null ou si on met 1
            $loo_quantity = isset($_POST['loo_quantity']) ? intval($_POST['loo_quantity']) : null;

            try {
                //un loot existe deja avec de nom
                if ($tresors->isNotUniqueLoot($_POST['loo_name'])) {
                    $_SESSION['error_message'] = "Un loot existe déjà avec ce nom.";
                    header("Location: " . $this->baseUrl . "/pannel_admin/creation_loot");
                    exit();
                }

                //insert le loot avec ses items
                $tresors->insertLoot($loo_name, $loo_quantity, $_POST['items']);

                header("Location: " . $this->baseUrl . "/pannel_admin/tresors");
                exit();
            } catch (Exception $e) {
                //erreur pendant l'insertion
                $_SESSION['error_message'] = "Une erreur est survenue lors de l'insertion : " . $e->getMessage();
                header("Location: " . $this->baseUrl . "/pannel_admin/creation_loot");
                exit();
            }
        } else {
            //rous les champs ne sont pas renseigné
            $_SESSION['error_message'] = "Le nom du loot est obligatoire.";
            header("Location: " . $this->baseUrl . "/pannel_admin/creation_loot");
            exit();
        }
        $connexion = null;
    }


    /**
     * suppression d'un loot
     */
    public function supprimerLoot()
    {
        $tresors = new Tresors(connect_db());
        // print_r($_POST);
        //si formulaire envoyé avec l'id d'un loot pour le supp
        if (isset($_POST['loo_id'])) {
            $loo_id = $_POST['loo_id'];
            //supp le loot
            $tresors->suppLoot($loo_id);

            //reuper la nouvelle liste des items
            $loots = $tresors->getAllLoots();
            header("Location: " . $this->baseUrl . "/pannel_admin/tresors");
            exit();
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        $connexion = null;
    }

    /**
     * affichage du formulaire de modificatoin d'un loot
     * et récupération des données d'un loot pour preremplir les champs
     */
    public function formModifierLoot()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_POST['loo_id']) || empty($_POST['loo_id'])) {
            $_SESSION['error_message'] = "Aucun loot spécifié.";
            header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
            exit();
        }

        $tresors = new Tresors(connect_db());


        $loo_id = intval($_POST['loo_id']);

        //recup données du loot
        try {
            //récupération de tous les items
            $items = $tresors->getAllItems();
            //récupération des donnes d'un loot

            // Récupération des données structurées du loot
            $loot = $tresors->getStructLoot($loo_id);

            if (!$loot) {
                $_SESSION['error_message'] = "Aucun loot trouvé";
                header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
                exit();
            }
            //affiche le formulaire de modification
            require_once 'views/pannel_admin/modifier_loot.php';
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Erreur lors de la récupération du loot : " . $e->getMessage();
            header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
            exit();
        }
        $connexion = null;
    }

    /**
     * traitement de la modification d'un loot
     */
    public function modifierLoot()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $tresors = new Tresors(connect_db());

        //verifie les champs
        if (
            isset($_POST['loo_id'], $_POST['loo_name']) && !empty($_POST['loo_id']) && !empty($_POST['loo_name'])
        ) {

            $loo_id = intval($_POST['loo_id']);
            $loo_name = trim(strip_tags($_POST['loo_name']));
            $loo_quantity = isset($_POST['loo_quantity']) ? intval($_POST['loo_quantity']) : null;
            $items = isset($_POST['items']) ? $_POST['items'] : null;

            //mise à jour de l'item
            try {
                $tresors->updateLoot($loo_id, $loo_name, $loo_quantity, $items);
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Erreur lors de la modification du loot : " . $e->getMessage();
                header(sprintf("Location: %s/pannel_admin/tresors/modifier_loot", $this->baseUrl));
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Tous les champs obligatoires sont requis.";
            header(sprintf("Location: %s/pannel_admin/tresors/modifier_item", $this->baseUrl));
            exit();
        }
        //redirige vers la page des tresors apres update
        header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
        $connexion = null;
    }
}
