<?php
class PersonnageController
{
    public function nouveau()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $playerId = $_SESSION['pla_id'] ?? null;
        //si connecté affiche formulaire création perso
        if ($playerId) {
            $classes = Classe::getAll();

            //répertoire contenant les images
            $dir = "Images/perso_pp";

            //récupérer tous les fichiers du répertoire
            $files = scandir($dir);

            //extensions images
            $image_extensions = array('jpg', 'jpeg', 'png');

            //filtrer les fichiers récup que ceux qui sont des images
            $images = array();
            foreach ($files as $file) {
                if ($file != 'no_pp.jpeg') {
                    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $image_extensions)) {
                        $images[] = $file;
                    }
                }
            }

            require 'views/creation_personnage.php';
        } else { //sinon redirige vers une page un le message d'erreur et btn pour se co
            //print_r($playerId);
            $this->afficherErreurAuth("Vous devez être connecté pour creer un personnage.");
        }
    }

    public function creer()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $nom = $_POST['nom'] ?? null;
        $classe_id = $_POST['classe'] ?? null;
        $biographie = $_POST['biographie'] ?? null;
        $joueur_id = $_SESSION['pla_id'] ?? null;

        $hero = new Hero();
        $hero->setNom($nom);
        $hero->setClasseId($classe_id);
        $hero->setBiographie($biographie);
        $hero->setJoueurId($joueur_id);
        $hero->save();


        $this->afficherPersonnages();
    }

    public function afficherPersonnages()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $playerId = $_SESSION['pla_id'] ?? null;

        if ($playerId) {
            $heros = new Hero();
            $res = $heros->getAllHeros($playerId);
            //echo $playerId;
            /*
            echo '<pre>';
            print_r($res);
            echo '</pre>';
            */
            require 'views/personnages.php';
        } else { //sinon redirige vers une page un le message d'erreur et btn pour se co
            $this->afficherErreurAuth("Vous devez être connecté pour voir vos personnages.");
        }
    }

    private function afficherErreurAuth($message)
    {
        require 'views/auth_error.php';
    }
}
