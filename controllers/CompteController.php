<?php
    class CompteController {

        public function form_create() {
            require_once 'views/form_account_creation.php';
        }

        public function create() {
            require_once 'views/create_account.php';
        }

        public function form_login() {
            require_once 'views/form_connexion.php';
        }

        public function login() {
            require_once 'views/traitement_connexion.php';
        }

        public function logout() {
            require_once 'views/deconnexion.php';
        }

        public function infos() {
            require_once 'views/infos_compte.php';
        }

        public function delete() {
            require_once 'views/supprimer_compte.php';
        }

    }