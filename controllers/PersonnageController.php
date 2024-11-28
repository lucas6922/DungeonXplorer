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

    public function nouveau()
    {
        $classeModel = new ClasseModel;
        $classes = $classeModel->getAllClass();
        require 'views/PersonnageCreation.php';
    }
}