<?php
require_once 'database/connexion_db.php';
class TresorsController
{

    private $baseUrl = '/DungeonXplorer';



    //---------------------------------------------------------------------------------------------------------//

    //TRESORS

    //---------------------------------------------------------------------------------------------------------//

    public function gererTresors()
    {
        $connexion = connect_db();

        //récupère les items
        $select = $connexion->query("SELECT * FROM ITEMS JOIN TYPE_ITEM USING(TYP_ID)");
        $items = $select->fetchAll(PDO::FETCH_ASSOC);
        if (!$items) {
            $items = [];
        }

        //récupère les loots
        $select = $connexion->query("SELECT * FROM LOOT");
        $loots = $select->fetchAll(PDO::FETCH_ASSOC);
        if (!$loots) {
            $loots = [];
        }
        require_once 'views/pannel_admin/tresors.php';
        $connexion = null;
    }

    public function formAjoutItem()
    {
        $connexion = connect_db();

        $rq = $connexion->prepare("SELECT TYP_ID, TYP_LIBELLE FROM TYPE_ITEM");
        $rq->execute();

        $types = $rq->fetchAll(PDO::FETCH_ASSOC);

        $connexion = null;
        require_once 'views/pannel_admin/creation_item.php';
    }

    public function ajoutItem()
    { {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $connexion = connect_db();

            if (
                isset($_POST['ite_name']) && !empty($_POST['ite_name'])
            ) {
                $ite_name = trim(strip_tags($_POST['ite_name']));
                $ite_description = isset($_POST['ite_poids']) ?  trim(strip_tags($_POST['ite_description'])) : null;
                $ite_poids = isset($_POST['ite_poids']) ? intval($_POST['ite_poids']) : null;
                $typ_id = isset($_POST['typ_id']) ? intval($_POST['typ_id']) : null;
                $ite_value = isset($_POST['ite_value']) ? intval($_POST['ite_value']) : null;


                try {
                    //unicite d'un item
                    $rqp = $connexion->prepare("SELECT 1 FROM ITEMS WHERE ite_name = :nom");
                    $rqp->execute(['nom' => $ite_name]);

                    if ($rqp->fetch()) {
                        //existe deja
                        $_SESSION['error_message'] = "Un item existe déjà avec ce nom.";
                        header("Location: " . $this->baseUrl . "/pannel_admin/creation_item");
                        exit();
                    }

                    //calcul l'id max
                    $rqp = $connexion->query("SELECT MAX(ITE_ID) AS maxi FROM ITEMS");
                    $result = $rqp->fetch(PDO::FETCH_OBJ);
                    //id + 1 pour le nouveau joueur
                    $id = $result->maxi + 1;


                    //insert le monstre
                    $rqp = $connexion->prepare("
                INSERT INTO ITEMS (ITE_ID, TYP_ID, ITE_NAME, ITE_DESCRIPTION, ITE_POIDS, ITE_VALUE) 
                VALUES ($id, :type, :name, :desc, :poid, :val)
            ");
                    $rqp->execute([
                        'type' => $typ_id,
                        'name' => $ite_name,
                        'desc' => $ite_description,
                        'poid' => $ite_poids,
                        'val' => $ite_value,
                    ]);

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

    public function supprimerItem()
    {
        $connexion = connect_db();

        //si formulaire envoyé avec l'id d'un item pour le supp
        if (isset($_POST['ite_id'])) {

            $ite_id = $_POST['ite_id'];
            //supp le joueur
            $rqp = $connexion->prepare("DELETE FROM ITEMS WHERE ITE_ID = ?");
            $rqp->execute([$ite_id]);

            //reuper la nouvelle liste des items
            $select = $connexion->query("SELECT * FROM ITEMS");
            $items = $select->fetchAll(PDO::FETCH_ASSOC);
            if (!$items) {
                $items = [];  //si aucun item trouvé
            }

            header("Location: " . $this->baseUrl . "/pannel_admin/tresors");
            exit();
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        $connexion = null;
    }

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

        //recup données de l'item
        try {
            $rq = $connexion->prepare("SELECT TYP_ID, TYP_LIBELLE FROM TYPE_ITEM");
            $rq->execute();

            $types = $rq->fetchAll(PDO::FETCH_ASSOC);

            $rq = $connexion->prepare("SELECT * FROM ITEMS JOIN TYPE_ITEM USING(TYP_ID) WHERE ITE_ID = :ite_id");
            $rq->execute(['ite_id' => $ite_id]);
            $item = $rq->fetch();

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

            $connexion = connect_db();

            //mise à jour de l'item
            try {
                $rq = $connexion->prepare("
                UPDATE ITEMS 
                SET ITE_NAME = :ite_name, ITE_DESCRIPTION = :ite_description, ITE_POIDS = :ite_poids, ITE_VALUE = :ite_value, 
                    TYP_ID = :typ_id
                WHERE ITE_ID = :ite_id
            ");
                $rq->execute([
                    'ite_name' => $ite_name,
                    'ite_description' => $ite_description,
                    'ite_poids' => $ite_poids,
                    'ite_value' => $ite_value,
                    'typ_id' => $typ_id,
                    'ite_id' => $ite_id
                ]);
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

    public function formAjoutLoot()
    {
        require_once 'views/pannel_admin/creation_loot.php';
    }

    public function ajoutLoot()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $connexion = connect_db();

        print_r($_POST);


        if (
            isset($_POST['loo_name']) && !empty($_POST['loo_name'])
        ) {
            $loo_name = trim(strip_tags($_POST['loo_name']));
            $loo_quantity = isset($_POST['loo_quantity']) ? intval($_POST['loo_quantity']) : null;


            try {
                //unicite d'un loot
                $rqp = $connexion->prepare("SELECT 1 FROM LOOT WHERE loo_name = :nom");
                $rqp->execute(['nom' => $loo_name]);

                if ($rqp->fetch()) {
                    //existe deja
                    $_SESSION['error_message'] = "Un loot existe déjà avec ce nom.";
                    header("Location: " . $this->baseUrl . "/pannel_admin/creation_loot");
                    exit();
                }


                //insert le monstre
                $rqp = $connexion->prepare("
            INSERT INTO LOOT (LOO_NAME,LOO_QUANTITY) 
            VALUES (:name, :quantity)");
                $rqp->execute([
                    'name' => $loo_name,
                    'quantity' => $loo_quantity,
                ]);

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


    public function supprimerLoot()
    {
        $connexion = connect_db();

        print_r($_POST);
        //si formulaire envoyé avec l'id d'un loot pour le supp
        if (isset($_POST['loo_id'])) {

            $loo_id = $_POST['loo_id'];
            //supp le joueur
            $rqp = $connexion->prepare("DELETE FROM LOOT WHERE LOO_ID = ?");
            $rqp->execute([$loo_id]);

            //reuper la nouvelle liste des items
            $select = $connexion->query("SELECT * FROM LOOT");
            $loots = $select->fetchAll(PDO::FETCH_ASSOC);
            if (!$loots) {
                $loots = [];  //si aucun loot trouvé
            }

            header("Location: " . $this->baseUrl . "/pannel_admin/tresors");
            exit();
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        $connexion = null;
    }

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

        $loo_id = intval($_POST['loo_id']);
        $connexion = connect_db();

        //recup données du loot
        try {

            $rq = $connexion->prepare("SELECT * FROM LOOT WHERE LOO_ID = :loo_id");
            $rq->execute(['loo_id' => $loo_id]);
            $loot = $rq->fetch();

            if (!$loot) {
                $_SESSION['error_message'] = "Loot introuvable.";
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
}
