<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';
require_once 'database/connexion_db.php';
$connexion = connect_db();

class Router
{
    private $routes = [];
    private $prefix;

    public function __construct($prefix = '')
    {
        $this->prefix = trim($prefix, '/');
    }

    public function addRoute($uri, $controllerMethod)
    {
        $this->routes[trim($uri, '/')] = $controllerMethod;
    }

    public function route($url)
    {
        // Enlève le préfixe du début de l'URL
        if ($this->prefix && strpos($url, $this->prefix) === 0) {
            $url = substr($url, strlen($this->prefix) + 1);
        }

        // Enlève les barres obliques en trop
        $url = trim($url, '/');

        // Vérification de la correspondance de l'URL à une route définie
        foreach ($this->routes as $route => $controllerMethod) {
            // Vérifie si l'URL correspond à une route avec des paramètres
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            // Si le nombre de segments correspond
            if (count($routeParts) === count($urlParts)) {
                // Vérification de chaque segment
                $params = [];
                $isMatch = true;
                foreach ($routeParts as $index => $part) {
                    if (preg_match('/^{\w+}$/', $part)) {
                        // Capture les paramètres
                        $params[] = $urlParts[$index];
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    // Extraction du nom du contrôleur et de la méthode
                    list($controllerName, $methodName) = explode('@', $controllerMethod);

                    // Instanciation du contrôleur et appel de la méthode avec les paramètres
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        // Si aucune route n'a été trouvée, gérer l'erreur 404
        require_once 'views/404.php';
    }
}

// Instanciation du routeur
$router = new Router('DungeonXplorer');

// Pour la racine
$router->addRoute('', 'AccueilController@index');
$router->addRoute('/', 'AccueilController@index');

//route pour la vue de cration d'un compte
$router->addRoute('creation_compte', 'CompteController@form_create');
//traitement du formulaire de la creatio nd'un compte
$router->addRoute('traitement_creation_compte', 'CompteController@create');

$router->addRoute('connexion', 'CompteController@form_login');
$router->addRoute('traitement_connexion', 'CompteController@login');
$router->addRoute('deconnexion', 'CompteController@logout');
$router->addRoute('infos_compte', 'CompteController@infos');
$router->addRoute('supprimer_compte', 'CompteController@delete');
//vue d'un chapitre
$router->addRoute('chapitre', 'ChapterController@show');
//routes pour la création d'un perso
$router->addRoute('creation_personnage', 'PersonnageController@nouveau');
$router->addRoute('traitement_creation_personnage', 'PersonnageController@creer');

//routes pour l'affichage des perso associé au joueur co
$router->addRoute('personnages', 'PersonnageController@afficherPersonnages');


// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));

$connexion = null;
