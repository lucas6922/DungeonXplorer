<?php
class PersonnageController
{
    public function index()
    {
        $personnageModel = new PersonnageModel;
        $tasks = $personnageModel->getAllPersonnages();

        require 'views/Personnage.php';
    }

    public function show($id)
    {
        // Logique pour afficher un personnage par son nom

        $personnageModel = new PersonnageModel;
        $task = $personnageModel->getPersonnage($id);

        require 'views/PersonnageDetail.php';
    }

    public function nouveau(){
        require 'views/creation_personnage.php';
    }

    public function creer(){
        session_start();
        
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

    }

    public function afficherPersonnages() {
        session_start();

        $playerId = $_SESSION['pla_id'] ?? null;

        if ($playerId) {
            $heros = new Hero();
            $heros->getAllHeros($playerId);
            echo $playerId;
            require 'views/personnages.php';
        } else {
            echo "Vous devez être connecté pour voir vos personnages.";
        }
    }
}