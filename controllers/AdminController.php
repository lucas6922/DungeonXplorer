<?php
require_once 'database/connexion_db.php';
class AdminController
{

    private $baseUrl = '/DungeonXplorer';

    public function showPannelAdmin()
    {
        require_once 'views/pannel_admin/pannel_admin_accueil.php';
    }


    //---------------------------------------------------------------------------------------------------------//

    //JOUEURS

    //---------------------------------------------------------------------------------------------------------//


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


    public function ajoutCompteAdmin()
    {
        require_once 'views/pannel_admin/creation_compte_admin.php';
    }

    //---------------------------------------------------------------------------------------------------------//

    //CHAPITRES

    //---------------------------------------------------------------------------------------------------------//

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
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
        exit();
        $connexion = null;
    }

    public function formAjoutChapitre()
    {
        $connexion = connect_db();

        $rq = $connexion->prepare("SELECT LOO_ID, LOO_NAME FROM LOOT");
        $rq->execute();

        $loots = $rq->fetchAll(PDO::FETCH_ASSOC);

        $connexion = null;
        require_once 'views/pannel_admin/creation_chapitre.php';
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
                header(sprintf("Location: %s/pannel_admin/creation_chapitre", $this->baseUrl));
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
                header(sprintf("Location: %s/pannel_admin/creation_chapitre", $this->baseUrl));
            }
        } else {
            $_SESSION['chap_creation_error'] = "le titre et la description du chapitre sont obligatoire";
            header(sprintf("Location: %s/pannel_admin/creation_chapitre", $this->baseUrl));
        }

        header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
        $connexion = null;
    }

    public function formModifChap()
    {
        if (!isset($_POST['cha_id']) || empty($_POST['cha_id'])) {
            $_SESSION['error_message'] = "Aucun chapitre spécifié.";
            header(sprintf("Location: %s/pannel_admin/chapitres", $this->baseUrl));
            exit();
        }

        $cha_id = intval($_POST['cha_id']);
        $connexion = connect_db();

        //recup données du chapitre
        try {
            //recupère les loots pour la selection
            $rq = $connexion->prepare("SELECT LOO_ID, LOO_NAME FROM LOOT");
            $rq->execute();

            $loots = $rq->fetchAll(PDO::FETCH_ASSOC);

            //recupère les données du chapitre (avec celle du loot associé)
            $rq = $connexion->prepare("SELECT * FROM CHAPTER JOIN LOOT USING(LOO_ID) WHERE CHA_ID = :cha_id");
            $rq->execute(['cha_id' => $cha_id]);
            $chapitre = $rq->fetch();

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


            $connexion = connect_db();

            //mise à jour du chapitre
            try {
                $rq = $connexion->prepare("
                    UPDATE CHAPTER 
                    SET CHA_NAME = :cha_name, CHA_CONTENT = :cha_content, CHA_IMAGE = :cha_image
                    WHERE CHA_ID = :cha_id
                ");
                $rq->execute([
                    'cha_name' => $cha_name,
                    'cha_content' => $cha_content,
                    'cha_id' => $cha_id,
                    'cha_image' => $cha_image
                ]);
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

    //---------------------------------------------------------------------------------------------------------//

    //MONSTRES

    //---------------------------------------------------------------------------------------------------------//


    public function gererMonstres()
    {
        $connexion = connect_db();

        $select = $connexion->query("SELECT * FROM MONSTER");
        $monsters = $select->fetchAll(PDO::FETCH_ASSOC);
        if (!$monsters) {
            $monsters = [];  //si aucun joueur trouvé
        }

        require_once 'views/pannel_admin/monstres.php';
        $connexion = null;
    }

    public function supprimerMonstre()
    {
        $connexion = connect_db();

        //si formulaire envoyé avec l'id d'un monstre pour le supp
        if (isset($_POST['mon_id'])) {

            $mon_id = $_POST['mon_id'];
            //supp le joueur
            $rqp = $connexion->prepare("DELETE FROM MONSTER WHERE MON_ID = ?");
            $rqp->execute([$mon_id]);

            //reuper la nouvelle liste des monstres
            $select = $connexion->query("SELECT * FROM MONSTER");
            $monstres = $select->fetchAll(PDO::FETCH_ASSOC);
            if (!$monstres) {
                $monstres = [];  //si aucun joueur trouvé
            }
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
        header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
        exit();
        $connexion = null;
    }

    public function formAjoutMonstre()
    {
        $connexion = connect_db();

        $rq = $connexion->prepare("SELECT LOO_ID, LOO_NAME FROM LOOT");
        $rq->execute();

        $loots = $rq->fetchAll(PDO::FETCH_ASSOC);

        $connexion = null;
        require_once 'views/pannel_admin/creation_monstre.php';
    }

    public function ajoutMonstre()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $connexion = connect_db();

        if (
            isset($_POST['loo_id'], $_POST['mon_name'], $_POST['mon_pv'], $_POST['mon_initiative'], $_POST['mon_strength'], $_POST['mon_xp']) &&
            !empty($_POST['loo_id']) && !empty($_POST['mon_name']) && !empty($_POST['mon_pv'])
            && !empty($_POST['mon_initiative']) && !empty($_POST['mon_strength'] && !empty($_POST['mon_xp']))
        ) {
            $loo_id = trim(strip_tags($_POST['loo_id']));
            $mon_name = trim(strip_tags($_POST['mon_name']));
            $mon_pv = intval($_POST['mon_pv']);
            $mon_mana = isset($_POST['mon_mana']) ? intval($_POST['mon_mana']) : null;
            $mon_initiative = intval($_POST['mon_initiative']);
            $mon_strength = intval($_POST['mon_strength']);
            $mon_attack = isset($_POST['mon_attack']) ? trim(strip_tags($_POST['mon_attack'])) : null;
            $mon_xp = isset($_POST['mon_xp']) ? intval($_POST['mon_xp']) : null;


            try {
                //unicite d'un monstre
                $rqp = $connexion->prepare("SELECT 1 FROM MONSTER WHERE mon_name = :nom");
                $rqp->execute(['nom' => $mon_name]);

                if ($rqp->fetch()) {
                    //existe deja
                    $_SESSION['mon_creation_error'] = "Un monstre existe déjà avec ce nom.";
                    header("Location: " . $this->baseUrl . "/pannel_admin/creation_monstre");
                    exit();
                }

                //calcul l'id max
                $rqp = $connexion->query("SELECT MAX(MON_ID) AS maxi FROM MONSTER");
                $result = $rqp->fetch(PDO::FETCH_OBJ);
                //id + 1 pour le nouveau joueur
                $id = $result->maxi + 1;


                //insert le monstre
                $rqp = $connexion->prepare("
                INSERT INTO MONSTER (MON_ID, LOO_ID, MON_NAME, MON_PV, MON_MANA, MON_INITIATIVE, MON_STRENGTH, MON_ATTACK, MON_XP)
                VALUES ($id, :loot, :name, :pv, :mana, :initiative, :strength, :attack, :xp)
            ");
                $rqp->execute([
                    'loot' => $loo_id,
                    'name' => $mon_name,
                    'pv' => $mon_pv,
                    'mana' => $mon_mana,
                    'initiative' => $mon_initiative,
                    'strength' => $mon_strength,
                    'attack' => $mon_attack,
                    'xp' => $mon_xp,
                ]);

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
            $_SESSION['mon_creation_error'] = "Le nom, les points de vie, l'initiative et la force du monstre sont obligatoires.";
            header("Location: " . $this->baseUrl . "/pannel_admin/creation_monstre");
            exit();
        }
        $connexion = null;
    }


    public function formModifierMonstre()
    {

        if (!isset($_POST['mon_id']) || empty($_POST['mon_id'])) {
            $_SESSION['error_message'] = "Aucun monstre spécifié.";
            header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
            exit();
        }

        $mon_id = intval($_POST['mon_id']);
        $connexion = connect_db();

        //recup données du monstre
        try {
            $rq = $connexion->prepare("SELECT LOO_ID, LOO_NAME FROM LOOT");
            $rq->execute();

            $loots = $rq->fetchAll(PDO::FETCH_ASSOC);

            $rq = $connexion->prepare("SELECT * FROM MONSTER JOIN LOOT USING(LOO_ID) WHERE MON_ID = :mon_id");
            $rq->execute(['mon_id' => $mon_id]);
            $monstre = $rq->fetch();

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
        $connexion = null;

        require_once 'views/pannel_admin/modifier_monstre.php';
    }

    public function modifierMonstre()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //verifie les champs
        if (
            isset($_POST['mon_id'], $_POST['mon_name'], $_POST['mon_pv'], $_POST['mon_initiative'], $_POST['mon_strength']) &&
            !empty($_POST['mon_id']) && !empty($_POST['mon_name']) && !empty($_POST['mon_pv']) && !empty($_POST['mon_initiative']) && !empty($_POST['mon_strength'])
        ) {

            $mon_id = intval($_POST['mon_id']);
            $mon_name = trim(strip_tags($_POST['mon_name']));
            $mon_pv = intval($_POST['mon_pv']);
            $mon_mana = isset($_POST['mon_mana']) ? intval($_POST['mon_mana']) : null;
            $mon_initiative = intval($_POST['mon_initiative']);
            $mon_strength = intval($_POST['mon_strength']);
            $mon_attack = isset($_POST['mon_attack']) ? trim(strip_tags($_POST['mon_attack'])) : null;
            $mon_xp = isset($_POST['mon_xp']) ? intval($_POST['mon_xp']) : null;

            $connexion = connect_db();

            //mise à jour du monstre
            try {
                $rq = $connexion->prepare("
                UPDATE MONSTER 
                SET MON_NAME = :mon_name, MON_PV = :mon_pv, MON_MANA = :mon_mana, MON_INITIATIVE = :mon_initiative, 
                    MON_STRENGTH = :mon_strength, MON_ATTACK = :mon_attack, MON_XP = :mon_xp
                WHERE MON_ID = :mon_id
            ");
                $rq->execute([
                    'mon_name' => $mon_name,
                    'mon_pv' => $mon_pv,
                    'mon_mana' => $mon_mana,
                    'mon_initiative' => $mon_initiative,
                    'mon_strength' => $mon_strength,
                    'mon_attack' => $mon_attack,
                    'mon_xp' => $mon_xp,
                    'mon_id' => $mon_id
                ]);
            } catch (Exception $e) {
                $_SESSION['mon_creation_error'] = "Erreur lors de la modification du monstre : " . $e->getMessage();
                header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
                exit();
            }
        } else {
            $_SESSION['mon_creation_error'] = "Tous les champs obligatoires sont requis.";
            header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
            exit();
        }
        //redirige vers la page des monstres apres update
        header(sprintf("Location: %s/pannel_admin/monstres", $this->baseUrl));
        $connexion = null;
    }



    public function gererImages()
    {
        require_once 'views/pannel_admin/images.php';
    }
}
