<?php
require_once 'database/connexion_db.php';
class AdminController
{

    public function showPannelAdmin()
    {
        require_once 'views/pannel_admin/pannel_admin_accueil.php';
    }

    public function gererJoueurs()
    {
        $connexion = connect_db();

        $select = $connexion->query("SELECT * FROM PLAYER");
        $joueurs = $select->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/pannel_admin/joueurs.php';
    }

    public function supprimerJoueur()
    {
        $connexion = connect_db();

        if (isset($_POST['pla_id'])) {
            $pla_id = $_POST['pla_id'];

            $rqp = $connexion->prepare("DELETE FROM PLAYER WHERE PLA_ID = ?");
            $rqp->execute([$pla_id]);

            header('Location: pannel_admin/joueurs');
        }
    }


    public function gererChapitres()
    {
        require_once 'views/pannel_admin/chapitres.php';
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
