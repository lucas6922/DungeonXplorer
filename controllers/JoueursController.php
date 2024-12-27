<?php
require_once 'database/connexion_db.php';

//---------------------------------------------------------------------------------------------------------//

//CONTROLLER JOUEURS

//---------------------------------------------------------------------------------------------------------//

class JoueursController
{
    public function gererJoueurs()
    {
        $joueurs = new Joueurs(connect_db());
        //recupère tous les joueurs
        $joueurs = $joueurs->getAllJoueurs();

        require_once 'views/pannel_admin/joueurs.php';
    }

    public function supprimerJoueur()
    {
        $joueurs = new Joueurs(connect_db());

        //si formulaire envoyé avec l'id d'un joueur pour le supp
        if (isset($_POST['pla_id'])) {

            $pla_id = $_POST['pla_id'];
            //supp le joueur
            $joueurs->suppJoueur($pla_id);

            //reuper la nouvelle liste des joueurs
            $joueurs = $joueurs->getAllJoueurs();
            require_once 'views/pannel_admin/joueurs.php';
        } else {
            echo "erreur lors de la suppression, aucun id recu";
        }
    }


    public function ajoutCompteAdmin()
    {
        require_once 'views/pannel_admin/creation_compte_admin.php';
    }
}
