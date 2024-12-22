<?php
class PersonnageController
{
    public function nouveau()
    {
        $playerId = $_SESSION['pla_id'] ?? null;

        //si connecté affiche formulaire création perso
        if ($playerId) {
            $classes = Classe::getAll();
            require 'views/creation_personnage.php';
        } else { //sinon redirige vers une page un le message d'erreur et btn pour se co
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
