<?php
    class PersonnageModel {
        public function getAllPersonnages() {
            // COn peut mettre ici le code nécessaire pour récupérer toutes les tâches depuis la base de données
            $list = []; //requête SQL pour avoir la liste des personnages en fontion du compte
            return $list;
        }

        public function getPersonnage($id) {
            $pers = 'requête SQL pour avoir le personnage(tout les détails) en fontion de son ID et de son compte';  
            return $pers;
        }
    }
?>