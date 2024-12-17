<?php

function connect_db() {
    try {
        // Chemin vers le fichier .env
        $envFile = __DIR__ . '/../.env';

        // Vérification de l'existence du fichier .env
        if (!file_exists($envFile)) {
            die("Le fichier .env n'existe pas.");
        }

        // Lecture du fichier .env et récupération des variables d'environnement
        $env = parse_ini_file($envFile);

        // Récupération des variables d'environnement
        $dbHost = $env['DB_HOST'];
        $dbName = $env['DB_NAME'];
        $dbUser = $env['DB_USER'];
        $dbPassword = $env['DB_PASSWORD'];
        // Connexion à la base de données
        $connexion = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
        // Définition des attributs de PDO pour afficher les erreurs
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*
        $select = $connexion->query("select count(*) as nb from PLAYER");
        $enregistrement = $select->fetch(PDO::FETCH_OBJ);

        echo "<PRE>";
        print_r($enregistrement);
        echo "</PRE>";

        // $connexion = null;
        */

        return $connexion;
        
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        exit;
    }
}