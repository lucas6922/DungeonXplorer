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

        $select = $connexion->query("SELECT * FROM ITEMS");
        $items = $select->fetchAll(PDO::FETCH_ASSOC);
        if (!$items) {
            $items = [];
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
                        $_SESSION['ite_creation_error'] = "Un item existe déjà avec ce nom.";
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
                    $_SESSION['ite_creation_error'] = "Une erreur est survenue lors de l'insertion : " . $e->getMessage();
                    header("Location: " . $this->baseUrl . "/pannel_admin/creation_monstre");
                    exit();
                }
            } else {
                //rous les champs ne sont pas renseigné
                $_SESSION['ite_creation_error'] = "Le nom de l'item esy obligatoire.";
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
        if (!isset($_POST['ite_id']) || empty($_POST['ite_id'])) {
            $_SESSION['error_message'] = "Aucun item spécifié.";
            header(sprintf("Location: %s/pannel_admin/tresors", $this->baseUrl));
            exit();
        }

        $ite_id = intval($_POST['ite_id']);
        $connexion = connect_db();

        //recup données de l'item
        try {
            $rq = $connexion->prepare("SELECT * FROM ITEMS WHERE ITE_ID = :ite_id");
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
}
